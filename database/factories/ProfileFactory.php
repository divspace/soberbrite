<?php

use App\Database\Models\Profile;
use App\Database\Models\User;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker): array {
    $sex = rand(1, 100) <= 75 ? 'male' : 'female';

    $phoneNumber = $faker->randomDigitNot(0);

    for ($i = 0; $i < 9; ++$i) {
        $phoneNumber .= $faker->randomDigit;
    }

    return [
        'user_id' => $faker->randomElement(User::pluck('id')->toArray()),
        'username' => $faker->unique()->userName,
        'first_name' => $faker->firstName($sex),
        'middle_name' => $faker->optional(25)->firstName($sex),
        'last_name' => $faker->lastName,
        'phone' => $phoneNumber,
        'gender' => ucfirst(substr($sex, 0, 1)),
        'birth_date' => $faker->dateTimeBetween('-90 years', '-20 years')->format('Y-m-d'),
        'sobriety_date' => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
    ];
});
