<?php

use App\Database\Models\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, fn (Faker $faker): array => [
    'code' => $faker->unique()->countryCode,
    'name' => $faker->unique()->country,
]);
