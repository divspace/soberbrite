<?php

use App\Database\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, fn(Faker $faker): array => [
    'code' => $faker->unique()->stateAbbr,
    'name' => $faker->unique()->state,
]);
