<?php

use Illuminate\Database\Seeder;
use App\Models\CitiesSearch;
use App\Models\ComparisonSearch;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CitiesSearch::class, 1000)->create();
        $faker = Faker\Factory::create();
        $cities = ['Mumbai', 'New York', 'Amsterdam', 'Rome', 'Athens', 'Warsaw', 'London', 'Tokyo', 'Los Angeles', 'Berlin', 'Belgrade', 'Ontario', 'Manchester', 'Paris', 'Milano'];

        for ($i=0; $i<500; $i++) {
            $cityOne = $faker->randomElement($cities);
            $cityTwo = $faker->randomElement($cities);
            while ($cityOne == $cityTwo) {
                $cityTwo = $faker->randomElement($cities);
            }
            ComparisonSearch::create([
                'city_one' => $cityOne,
                'city_two' => $cityTwo
            ]);
            ComparisonSearch::create([
                'city_one' => $cityTwo,
                'city_two' => $cityOne
            ]);
        }
    }
}
