<?php

use App\Database\Models\Address;
use App\Database\Models\Profile;
use App\Database\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $primaryUser = factory(User::class)->create([
            'email' => 'kyle@soberbrite.com',
        ]);

        factory(Address::class)->create([
            'user_id' => $primaryUser->id,
            'line_1' => '3300 N Scottsdale Rd',
            'line_2' => null,
            'city' => 'Scottsdale',
            'state' => 'AZ',
            'zip_code' => '85251',
        ]);

        factory(Profile::class)->create([
            'user_id' => $primaryUser->id,
            'username' => 'soberbrite',
            'first_name' => 'Kyle',
            'middle_name' => null,
            'last_name' => 'Anderson',
            'sobriety_date' => '2020-03-15',
        ]);

        factory(User::class, 50)->create()->each(function ($user) {
            $user->address()->save(factory(Address::class)->make());
            $user->profile()->save(factory(Profile::class)->make());
        });
    }
}
