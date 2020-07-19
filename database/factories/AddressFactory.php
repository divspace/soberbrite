<?php

/** @var Factory $factory */

use App\Database\Models\Address;
use App\Database\Models\Location;
use App\Database\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Address::class, fn (Faker $faker): array => [
    'user_id' => User::inRandomOrder()->pluck('id')->first(),
    'location_id' => Location::inRandomOrder()->limit(100)->pluck('id')->first(),
    'street' => $faker->streetAddress,
]);
