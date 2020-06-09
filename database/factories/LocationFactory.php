<?php

use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use Faker\Generator as Faker;

$factory->define(Location::class, fn (Faker $faker): array => [
    Location::CITY => fn () => factory(City::class)->create()->id,
    Location::STATE => fn () => factory(State::class)->create()->id,
    Location::ZIP_CODE => fn () => factory(ZipCode::class)->create()->id,
    Location::LATITUDE => $faker->latitude,
    Location::LONGITUDE => $faker->longitude,
    Location::TIMEZONE_OFFSET => random_int(-10, -4).':00:00',
    Location::OBSERVES_DST => random_int(0, 1),
]);
