<?php

use App\Database\Models\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'line_1' => $faker->streetAddress,
        'line_2' => $faker->optional(25)->secondaryAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip_code' => $faker->postcode,
    ];
});
