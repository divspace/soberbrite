<?php

use App\Database\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    $sex = rand(1, 100) <= 75 ? 'male' : 'female';

    $phoneNumber = $faker->randomDigitNot(0);

    for ($i = 0; $i < 9; ++$i) {
        $phoneNumber .= $faker->randomDigit;
    }

    return [
        'username' => $faker->unique()->userName,
        'first_name' => $faker->firstName($sex),
        'middle_name' => $faker->optional(25)->firstName($sex),
        'last_name' => $faker->lastName,
        'phone' => $phoneNumber,
        'sobriety_date' => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
    ];
});
