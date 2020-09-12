<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Database\Models\Address;
use App\Database\Models\Location;
use App\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

final class AddressFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'location_id' => Location::inRandomOrder()->limit(100)->pluck('id')->first(),
            'street' => $this->faker->streetAddress,
        ];
    }
}
