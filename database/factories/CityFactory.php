<?php

use App\Database\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker): array {
    return [
        'name' => $faker->unique()->city,
    ];
});
