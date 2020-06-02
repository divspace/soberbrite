<?php

use App\Database\Models\Address;
use App\Database\Models\Location;
use App\Database\Models\User;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker): array {
    return [
        'user_id' => $faker->randomElement(User::pluck('id')->toArray()),
        'location_id' => $faker->randomElement(Location::pluck('id')->toArray()),
        'street' => $faker->streetAddress,
    ];
});
