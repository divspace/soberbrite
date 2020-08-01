<?php

declare(strict_types = 1);

/** @var Factory $factory */

use App\Database\Models\AreaCode;
use App\Database\Models\Profile;
use App\Database\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Profile::class, static function (Faker $faker): array {
    $sex = random_int(1, 100) <= 75 ? 'male' : 'female';
    $areaCode = AreaCode::inRandomOrder()->limit(100)->pluck('code')->first();

    return [
        'user_id' => User::inRandomOrder()->pluck('id')->first(),
        'username' => $faker->unique()->userName,
        'first_name' => $faker->firstName($sex),
        'middle_name' => $faker->optional(25)->firstName($sex),
        'last_name' => $faker->lastName,
        'phone' => $areaCode.$faker->randomDigitNot(0).$faker->randomNumber(6, true),
        'gender' => ucfirst($sex[0]),
        'birth_date' => $faker->dateTimeBetween('-90 years', '-20 years')->format('Y-m-d'),
        'sobriety_date' => $faker->dateTimeBetween()->format('Y-m-d'),
    ];
});
