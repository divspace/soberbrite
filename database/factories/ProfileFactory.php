<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Database\Models\AreaCode;
use App\Database\Models\Profile;
use App\Database\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

final class ProfileFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Profile::class;

    /**
     * @throws Exception
     */
    public function definition(): array
    {
        $sex = random_int(1, 100) <= 75 ? 'male' : 'female';
        $areaCode = AreaCode::inRandomOrder()->limit(100)->pluck('code')->first();

        return [
            'user_id' => User::inRandomOrder()->pluck('id')->first(),
            'username' => $this->faker->unique()->userName,
            'first_name' => $this->faker->firstName($sex),
            'middle_name' => $this->faker->optional(25)->firstName($sex),
            'last_name' => $this->faker->lastName,
            'phone' => $areaCode.$this->faker->randomDigitNot(0).$this->faker->randomNumber(6, true),
            'gender' => ucfirst($sex[0]),
            'birth_date' => $this->faker->dateTimeBetween('-90 years', '-20 years')->format('Y-m-d'),
            'sobriety_date' => $this->faker->dateTimeBetween()->format('Y-m-d'),
        ];
    }
}
