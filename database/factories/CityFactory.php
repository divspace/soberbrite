<?php

use App\Database\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, fn(Faker $faker): array => [
    'name' => $faker->unique()->city,
]);
