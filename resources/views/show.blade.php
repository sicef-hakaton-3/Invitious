@extends('layout.app')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/owl.carousel.css') }}">
@endsection
@section('content')
<div class="container">

    <div class="col-xs-12 city-info-page no-bg no-shadow">
        <div class="col-xs-6 no-pad-left compare-input">
            <form method="get" action="{{ route("compare-cities") }}">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button id="search-button1" type="submit" disabled class="btn btn-default" value="compare">compare</button>
                    </div>
                    <input type="search" id="land-search1" name="city_two" class="form-control" required placeholder="Compare with ..." aria-describedby="basic-addon1" name="city" autocomplete="off">
                    <input type="hidden" value="{{ app('request')->input('city') }}" name="city_one">
                </div>
                <span class="hidden-msg">{{explode(',', $_GET['city'])[0]}} is mostly being compared with {{$topCompare->city_two}}.</span>
            </form>
        </div>
        <div class="col-xs-6 no-pad-right">
            <form method="get" action="{{ route('get-city-info') }}">
                <div class="input-group">
                    <input type="search" id="land-search" class="form-control" required placeholder="Search again ..." aria-describedby="basic-addon1" name="city" autocomplete="off">
                    <span class="input-group-btn no-pad">
                        <button id="search-button" class="btn btn-default" disabled type="submit">search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="city-info-page">

        <div class="col-xs-12 city-cover no-pad">
            <img id="place-image" src="{{ $cityPhoto->photos[0]->image->web}}" data-web="{{ $cityPhoto->photos[0]->image->web}}" data-thumb="{{ $cityPhoto->photos[0]->image->mobile}}" alt="">

            <div class="col-xs-12 city-basic-info">
                <div class="col-md-6">
                    <h1>{{ $cityName }}</h1>
                </div>
                <div class="col-md-6 text-center">
                    <div class="col-sm-3 col-xs-6 no-pad">
                        <i class="material-icons" data-toggle="tooltip" data-placement="top" title="" data-original-title="Population">group</i>
                        <br>
                        {{round($city->categories[1]->data[0]->float_value, 2)}} mil.
                    </div>
                    <div class="col-sm-3 col-xs-6 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Climate">
                        <i class="material-icons">wb_sunny</i>
                        <br>
                        {{ $city->categories[2]->data[count($city->categories[2]->data) - 1]->string_value }}
                    </div>
                    <div class="col-sm-3 col-xs-6 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Language">
                        <i class="material-icons">language</i>
                        <br>
                        {{ $city->categories[10]->data[2]->string_value }}
                    </div>
                    <div class="col-sm-3 col-xs-6 no-pad" data-toggle="tooltip" data-placement="top" title="" data-original-title="Currency">
                        <img src="{{ asset('img/city-currency.png') }}">
                        <br>
                        {{ $city->categories[5]->data[0]->string_value }}
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 city-description">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Show</li>
            </ol>
            {!! str_replace('Teleport', 'iMove', $citySummary->summary) !!}
        </div>

        <div class="col-xs-12 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left">Cost of living</h2>
                <div class="rate-stars pull-left">
                    @for($i=5; $i>=1; $i--)
                        <i class="material-icons">@if($i > $livingCostsScore) star @else star_border @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[1]->label }}</label> {{ $city->categories[3]->data[1]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[2]->label }}</label> {{ $city->categories[3]->data[2]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[3]->label }}</label> {{ $city->categories[3]->data[3]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[4]->label }}</label> {{ $city->categories[3]->data[4]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>Monthly Fitness</label> {{ $city->categories[3]->data[5]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[6]->label }}</label> {{ $city->categories[3]->data[6]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[7]->label }}</label> {{ $city->categories[3]->data[7]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[8]->label }}</label> {{ $city->categories[3]->data[8]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[3]->data[9]->label }}</label> {{ $city->categories[3]->data[9]->currency_dollar_value }}
                </div>
                <div class="col-xs-4">
                    <label>Meal at restaurant</label> {{ $city->categories[3]->data[10]->currency_dollar_value }}
                </div>
            </div>
        </div>

        <div class="col-xs-12 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left">Culture</h2>
                <div class="rate-stars pull-left">
                    @for($i=1; $i<=5; $i++)
                        <i class="material-icons">@if($i > $cultureScore) star_border @else star @endif</i>
                    @endfor
                </div>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[1]->label }}</label> {{ $city->categories[4]->data[1]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[3]->label }}</label> {{ $city->categories[4]->data[3]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[5]->label }}</label> {{ $city->categories[4]->data[5]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[7]->label }}</label> {{ $city->categories[4]->data[7]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[9]->label }}</label> {{ $city->categories[4]->data[9]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[11]->label }}</label> {{ $city->categories[4]->data[11]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[13]->label }}</label> {{ $city->categories[4]->data[13]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[15]->label }}</label> {{ $city->categories[4]->data[15]->int_value }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[4]->data[17]->label }}</label> {{ $city->categories[4]->data[17]->int_value }}
                </div>
            </div>
        </div>
        <div class="col-xs-12 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left">More info</h2>
            </div>
            <div class="col-xs-12 city-stats-labels">
                <div class="col-xs-4">
                    <label>{{ $city->categories[5]->data[1]->label }}</label> {{ $city->categories[5]->data[1]->percent_value*100 }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[7]->data[1]->label }}</label> {{ round($city->categories[7]->data[1]->float_value, 2) }}
                </div>
                <div class="col-xs-4">
                    <label>Healt Care Quality</label> {{ $city->categories[7]->data[3]->float_value*100 }}/100
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[8]->data[0]->label }}</label> {{ round($city->categories[8]->data[0]->currency_dollar_value) }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[8]->data[1]->label }}</label> {{ round($city->categories[8]->data[1]->currency_dollar_value) }}
                </div>
                <div class="col-xs-4">
                    <label>{{ $city->categories[8]->data[2]->label }}</label> {{ round($city->categories[8]->data[2]->currency_dollar_value) }}
                </div>
            </div>
        </div>
        <div class="col-xs-12 city-stats-section no-pad">
            <div class="city-stats-title">
                <h2 class="pull-left">Employeers</h2>
            </div>
            <div class="owl-employee text-center">
                @foreach($employers as $employer)
                <div>
                    <img src="{{ $employer->squareLogo }}" alt="">
                    <a href="http://{{ $employer->website }}" target="_blank"><p class="text-center">{{ $employer->name }}</p></a>
                    {{--<p class="text-center employee-info">@if(!empty($employer->sectorName)){{ $employer->sectorName }} - @endif {{ $employer->overallRating }}</p>--}}
                    <span class="badge">{{ $employer->overallRating }}</span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-md-5 twitter-wrapper"></div>
            <div class="col-md-7" id="map"></div>
            <button type="button" class="btn btn-raised btn-primary btn-modal" data-toggle="modal" data-target="#searchModal">List</button>

            <!-- Modal -->
            <div id="searchModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Schools list</h4>
                        </div>
                        <div class="modal-body search-modal-body">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--<div class="col-xs-12 city-info-section">--}}
            {{--<div class="col-xs-12 city-info-section-title">--}}
                {{--<span><h1 class="pull-left">Landmarks</h1><a href="#" target="_blank" class="pull-right">show all</a></span>--}}
            {{--</div>--}}
            {{--<div class="col-xs-12 no-pad">--}}
                {{--<div class="col-xs-3 city-info-box">--}}
                    {{--<img src="{{ asset('img/city-info-box-img.jpg') }}"><a href="" ><i class="material-icons">place</i></a>--}}
                {{--</div>--}}
                {{--<div class="col-xs-3 city-info-box">--}}
                    {{--<img src="{{ asset('img/city-info-box-img.jpg') }}"><a href="" ><i class="material-icons">place</i></a>--}}
                {{--</div>--}}
                {{--<div class="col-xs-3 city-info-box">--}}
                    {{--<img src="{{ asset('img/city-info-box-img.jpg') }}"><a href="" ><i class="material-icons">place</i></a>--}}
                {{--</div>--}}
                {{--<div class="col-xs-3 city-info-box">--}}
                    {{--<img src="{{ asset('img/city-info-box-img.jpg') }}"><a href="" ><i class="material-icons">place</i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/show.js') }}"></script>
<script type="text/javascript">
    var city = <?php echo json_encode($_GET['city']); ?> ;
    var cityParsed = <?php echo json_encode(explode(',',$_GET['city'])[0]); ?> ;
    var contentInfo = [];
    var markers = [];
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            zoomControl: false
        });

        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': city}, function(results, status) {
            if (status == 'OK') {
                map.setCenter(results[0].geometry.location);
                map.setZoom(11);
            }
        });

        var infowindow = new google.maps.InfoWindow({
        });

        $.ajax({
            type: "GET",
            url: '/getSchoolsByCity',
            data: {
                'city': city,
                '_token': document.getElementsByTagName("meta")["csrf-token"].getAttribute("content")
            },
            success: function( result ) {
                var ul = document.createElement('ul');
                for(var i=0; i<result.schools.results.length; i++) {
                    contentInfo.push(result.schools.results[i].name);
                    var li = document.createElement('li');
                    $(li).append(result.schools.results[i].name).click(function(){
                        for(i=0; i<markers.length; i++){
                            if (i == $(this).index())
                                markers[i].setVisible(true);
                            else
                                markers[i].setVisible(false);
                        }
                        $("#searchModal").modal('hide');
                    });
                    $(ul).append(li);

                    var marker = new google.maps.Marker({
                        position: result.schools.results[i].geometry.location,
                        map: map,
                        icon: '/img/marker.png'
                    });
                    marker.number = i;

                    markers.push(marker);

                    marker.addListener('click', function() {
                        infowindow.setContent(contentInfo[this.number]);
                        infowindow.open(map, marker);
                    });
                    google.maps.event.addListener(marker,'mouseover', (function(marker, infowindow){
                        return function() {
                            infowindow.setContent(contentInfo[this.number]);
                            infowindow.open(map, marker);
                        };
                    })(marker, infowindow));
                }
                $('.search-modal-body').append(ul);
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyALl49QDz18EBaeCzbcCOUD24lai5_52Do&callback=initMap">
</script>
@endsection
