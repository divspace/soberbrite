<?php

use App\Database\Models\Program;
use Faker\Generator as Faker;

$factory->define(Program::class, fn(Faker $faker): array => [
    'program_type_id' => random_int(1, 2),
    'name' => $faker->company,
    'abbreviation' => null,
]);
