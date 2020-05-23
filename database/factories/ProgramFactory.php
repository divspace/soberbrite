<?php

use App\Database\Models\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'program_type_id' => rand(1, 2),
        'name' => $faker->company,
        'abbreviation' => null,
    ];
});
