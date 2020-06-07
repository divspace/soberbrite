<?php

use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use Faker\Generator as Faker;

$factory->define(Location::class, fn (Faker $faker): array => [
    'city_id' => fn () => factory(City::class)->create()->id,
    'state_id' => fn () => factory(State::class)->create()->id,
    'zip_code_id' => fn () => factory(ZipCode::class)->create()->id,
    'latitude' => $faker->latitude,
    'longitude' => $faker->longitude,
    'timezone_offset' => random_int(-10, -4).':00:00',
    'observes_dst' => random_int(0, 1),
]);
