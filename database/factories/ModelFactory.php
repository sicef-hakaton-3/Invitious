<?php

use App\Models\CitiesSearch;

$factory->define(CitiesSearch::Class, function (Faker\Generator $faker) {
    $cities = ['Mumbai', 'New York', 'Amsterdam', 'Rome', 'Athens', 'Warsaw', 'London', 'Tokyo', 'Los Angeles', 'Berlin', 'Belgrade', 'Ontario', 'Manchester', 'Paris', 'Milano'];
    return [
        'city' => $faker->randomElement($cities)
    ];
});

