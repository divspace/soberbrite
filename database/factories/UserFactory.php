<?php

use App\Database\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

$factory->define(User::class, function (Faker $faker) {
    return [
        'uuid' => Uuid::uuid4()->getBytes(),
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'email_verified_at' => now(),
    ];
});
