<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'email_verified_at' => Carbon::now(),
        ];
    }
}
