<?php

use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(Location::class, function (Faker $faker): array {
    return [
        'city_id' => fn () => factory(City::class)->create()->id,
        'state_id' => fn () => factory(State::class)->create()->id,
        'zip_code_id' => fn () => factory(ZipCode::class)->create()->id,
        'coordinate' => new Point($faker->latitude, $faker->longitude),
        'timezone_offset' => random_int(-10, -4).':00:00',
        'observes_dst' => random_int(0, 1),
    ];
});
