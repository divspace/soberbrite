<?php

use App\Database\Models\Profile;
use App\Database\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        factory(Profile::class)->create([
            'user_id' => factory(User::class)->create([
                'email' => 'kyle@soberbrite.com',
            ])->id,
            'username' => 'soberbrite',
            'first_name' => 'Kyle',
            'middle_name' => null,
            'last_name' => 'Anderson',
            'sobriety_date' => '2020-03-15',
        ]);

        factory(User::class, 50)->create()->each(function ($user) {
            $user->profile()->save(factory(Profile::class)->make());
        });
    }
}
