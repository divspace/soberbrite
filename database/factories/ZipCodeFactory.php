<?php

use App\Database\Models\ZipCode;
use Faker\Generator as Faker;

$factory->define(ZipCode::class, fn (Faker $faker): array => [
    'code' => substr($faker->unique()->postcode, 0, 5),
]);
