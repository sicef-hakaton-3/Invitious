<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GooglePlaces;
use Twitter;
use App\Models\CitiesSearch;
use App\Models\ComparisonSearch;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topCities = CitiesSearch::select(DB::raw('city, count(*) as number'))
            ->groupBy('city')
            ->orderBy('number', 'desc')
            ->limit(9)
            ->get();
        return view('welcome')
            ->with('topCities' , $topCities);
    }

    public function autoComplete(Request $request)
    {
        $response = GooglePlaces::placeAutocomplete($request->get('query'));

        $data = json_decode($response);

        $newReponse = array();

        foreach ($data->predictions as $prediction) {
            $item = array();
            $item['name'] = $prediction->description;
//            $item['name'] = $prediction->terms[0]->value;
            $newReponse[] = $item;
        }

        return response()->json($newReponse);
    }

    public function getTweetsByHashTag(Request $request)
    {
        $city = $request->input('city');

        $tweets = Twitter::linkify($city);
        $query = array(
            'q' => '#'.$tweets
        );
        $data = Twitter::get('search/tweets',$query);

        return response()->json($data);
    }

    public function getEmployersByCity(Request $request)
    {
        $city = $request->input('city');
        $url = 'http://api.glassdoor.com/api/api.htm?v=1&format=json&t.p=104899&t.k=fUJPYUpM8D1&action=employers&city='.$city;

        $employers = json_decode(file_get_contents($url));
        return response()
            ->json(['employers' => $employers->response->employers]);
    }

    public function getSchoolsByCity(Request $request)
    {
        $latLng = GooglePlaces::textSearch($request->input('city'), []);

        $schools = GooglePlaces::nearbySearch($latLng['results'][0]['geometry']['location']['lat'].','.$latLng['results'][0]['geometry']['location']['lng'], 10000, ['type' => 'school']);

        return response()
            ->json(['schools' => $schools]);
    }

    public function getCityInfo(Request $request)
    {
        $searchCity = new CitiesSearch();

        if (strpos($request->input('city'), ',')) {
            $cityTmp = substr($request->input('city'), 0, strpos($request->input('city'), ','));
        } else {
            $cityTmp = substr($request->input('city'), 0);
        }

        $searchCity->city = $cityTmp;
        $searchCity->save();

        $cityTmp = str_replace(' ', '-', strtolower($cityTmp));
        $url = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityTmp.'/';
        $urlEmployers = 'http://api.glassdoor.com/api/api.htm?v=1&format=json&t.p=104899&t.k=fUJPYUpM8D1&action=employers&city='.$cityTmp;

        $imageUrl = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityTmp.'/images';

        if (!$data = @file_get_contents($url)) {
            abort(404);
        }
        $photoData = @file_get_contents($imageUrl);

        $cityInfo = json_decode($data);
        $cityPhoto = json_decode($photoData);

        if (isset($cityInfo->http_status_code)) {
            if ($cityInfo->http_status_code == 404) {
                abort(404);
            }
        }

        $cityUaId = $cityInfo->ua_id;

        $cityInfoUrl = 'https://api.teleport.org/api/urban_areas/teleport%3A'.$cityUaId.'/details/';
        $summaryUrl = 'https://api.teleport.org/api/urban_areas/teleport%3A'.$cityUaId.'/scores/';

        if (!$data = @file_get_contents($cityInfoUrl)) {
            abort(404);
        }
        $city = json_decode(file_get_contents($cityInfoUrl));
        $summary = json_decode(file_get_contents($summaryUrl));

        $livingCostsScore= $this->calculateLivingCostScore($city->categories[3]->data);
        $cultureScore = $this->calculateCulturalScore($city->categories[4]->data);

        $employers = json_decode(file_get_contents($urlEmployers));
        $employers = $employers->response->employers;

        $topCompare = ComparisonSearch::select(DB::raw('city_two, count(city_two) as number'))
            ->groupBy('city_two')
            ->where('city_one', $cityTmp)
            ->orderBy('number', 'desc')
            ->first();

        return view('show')->with('city' , $city)
            ->with('livingCostsScore' , $livingCostsScore)
            ->with('cultureScore' , $cultureScore)
            ->with('cityPhoto' , $cityPhoto)
            ->with('citySummary' , $summary)
            ->with('cityName' , $cityInfo->full_name)
            ->with('employers', $employers)
            ->with('topCompare', $topCompare);
    }

    public function compareCities(Request $request)
    {
        $searchCompare = new ComparisonSearch();
        $searchCompare1 = new ComparisonSearch();


        $cityOne = substr($request->input('city_one'), 0, strpos($request->input('city_one'), ','));
        $cityTwo = substr($request->input('city_two'), 0, strpos($request->input('city_two'), ','));

        $searchCompare->city_one = $cityOne;
        $searchCompare1->city_two = $cityOne;

        $searchCompare->city_two = $cityTwo;
        $searchCompare1->city_one = $cityTwo;

        $searchCompare->save();
        $searchCompare1->save();

        $cityOne = str_replace(' ', '-', strtolower($cityOne));
        $cityTwo = str_replace(' ', '-', strtolower($cityTwo));

        $urlOne = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityOne.'/';
        $urlTwo = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityTwo.'/';

        $imageOneUrl = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityOne.'/images';
        $imageTwoUrl = 'https://api.teleport.org/api/urban_areas/slug%3A'.$cityTwo.'/images';

        $photoOneData = @file_get_contents($imageOneUrl);
        $photoTwoData = @file_get_contents($imageTwoUrl);

        $cityOnePhoto = json_decode($photoOneData);
        $cityTwoPhoto = json_decode($photoTwoData);

        if (!$dataOne = @file_get_contents($urlOne) ) {
            abort(404);
        }
        if (!$dataTwo = @file_get_contents($urlTwo) ) {
            abort(404);
        }

        $cityOne = json_decode($dataOne);
        $cityTwo = json_decode($dataTwo);

        $id1 = $cityOne->ua_id;
        $id2 = $cityTwo->ua_id;

        $cityOneInfoUrl = 'https://api.teleport.org/api/urban_areas/teleport%3A'.$id1.'/details/';
        $cityTwoInfoUrl = 'https://api.teleport.org/api/urban_areas/teleport%3A'.$id2.'/details/';

        $cityOneInfo = json_decode(file_get_contents($cityOneInfoUrl));
        $cityTwoInfo = json_decode(file_get_contents($cityTwoInfoUrl));

        $livingCostsScoreCityOne= $this->calculateLivingCostScore($cityOneInfo->categories[3]->data);
        $cultureScoreCityOne = $this->calculateCulturalScore($cityOneInfo->categories[4]->data);
        $livingCostsScoreCityTwo = $this->calculateLivingCostScore($cityTwoInfo->categories[3]->data);
        $cultureScoreCityTwo = $this->calculateCulturalScore($cityTwoInfo->categories[4]->data);

        return view('compare')->with('cityOne' , $cityOneInfo)
        ->with('cityTwo' , $cityTwoInfo)
        ->with('livingCostsScoreCityOne' , $livingCostsScoreCityOne)
        ->with('cultureScoreCityOne' , $cultureScoreCityOne)
        ->with('livingCostsScoreCityTwo' , $livingCostsScoreCityTwo)
        ->with('cultureScoreCityTwo' , $cultureScoreCityTwo)
        ->with('cityOneName' , $cityOne->full_name)
        ->with('cityTwoName' , $cityTwo->full_name)
        ->with('cityOnePhoto' , $cityOnePhoto)
        ->with('cityTwoPhoto' , $cityTwoPhoto);
    }
    private function calculateLivingCostScore($inputs)
    {
        $livingCostsScore = 0;

        foreach ($inputs as $key => $input) {
            if($key != 0) {
                $livingCostsScore += $input->currency_dollar_value;
            }

        }
        //Calculated formula
        return  round($livingCostsScore/64)-1;
    }

    private function calculateCulturalScore($inputs)
    {
        $cultureScore = 0;

        foreach ($inputs as $input) {
            if(!empty($input->float_value)) {
                $cultureScore += $input->float_value;
            }
        }
        //Calculated formula
        return $cultureScore/1.8;
    }
}
