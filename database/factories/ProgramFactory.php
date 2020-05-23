<?php

use App\Database\Models\Program;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Program::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->getBytes(),
        'program_type_id' => rand(1, 2),
        'name' => $faker->company,
        'abbreviation' => null,
    ];
});
