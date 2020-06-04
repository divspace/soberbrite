<?php

use App\Database\Models\AreaCode;
use App\Database\Models\State;
use Faker\Generator as Faker;

$factory->define(AreaCode::class, fn(Faker $faker): array => [
    'state_id' => fn () => factory(State::class)->create()->id,
    'code' => $faker->areaCode,
]);
