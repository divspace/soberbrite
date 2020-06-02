<?php

use App\Database\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker): array {
    return [
        'code' => $faker->unique()->stateAbbr,
        'name' => $faker->unique()->state,
    ];
});
