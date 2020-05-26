<?php

use App\Database\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        'code' => $faker->unique()->stateAbbr,
        'name' => $faker->state,
    ];
});
