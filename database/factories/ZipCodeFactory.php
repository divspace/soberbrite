<?php

use App\Database\Models\ZipCode;
use Faker\Generator as Faker;

$factory->define(ZipCode::class, function (Faker $faker) {
    return [
        'code' => substr($faker->unique()->postcode, 0, 5),
    ];
});
