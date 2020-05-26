<?php

use App\Database\Models\Address;
use App\Database\Models\User;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(User::pluck('id')->toArray()),
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'zip_code' => substr($faker->postcode, 0, 5),
    ];
});
