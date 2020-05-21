<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'first_name' => 'Kyle',
            'last_name' => 'Anderson',
            'email' => 'kyle@soberbrite.com',
            'sobriety_date' => '2020-03-15',
        ]);
    }
}
