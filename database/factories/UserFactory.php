<?php

use App\Database\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$argon2id$v=19$m=1024,t=2,p=2$M0F1Y0VFeUoza2VFRW9GUg$VdtmnRfhQ/ZupTEXpK43lymW6jTWU0GrmTdDwJI4t8Q', // password
        'sobriety_date' => $faker->date('Y-m-d', 'now'),
        'remember_token' => Str::random(10),
        'email_verified_at' => now(),
    ];
});
