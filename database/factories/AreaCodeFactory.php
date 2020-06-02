<?php

use App\Database\Models\AreaCode;
use App\Database\Models\State;
use Faker\Generator as Faker;

$factory->define(AreaCode::class, function (Faker $faker) {
    return [
        'state_id' => fn () => factory(State::class)->create()->id,
        'code' => $faker->numberBetween(2, 9).$faker->randomDigit().$faker->randomDigit(),
    ];
});
