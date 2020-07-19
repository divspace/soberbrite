<?php

/** @var Factory $factory */

use App\Database\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, fn (Faker $faker): array => [
    'email' => $faker->unique()->safeEmail,
    'password' => Hash::make('password'),
    'remember_token' => Str::random(10),
    'email_verified_at' => now(),
]);
