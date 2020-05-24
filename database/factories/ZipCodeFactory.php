<?php

use App\Database\Models\ZipCode;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(ZipCode::class, function (Faker $faker) {
    return [
        'zip' => substr($faker->postcode, 0, 5),
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'coordinate' => new Point($faker->latitude, $faker->longitude),
        'timezone_offset' => rand(-10, -4).':00:00',
        'has_dst' => rand(0, 1),
    ];
});
