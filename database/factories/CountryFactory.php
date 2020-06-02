<?php

use App\Database\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->countryCode,
        'name' => $faker->unique()->country,
    ];
});
