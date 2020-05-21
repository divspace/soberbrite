<?php

use App\Database\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'email' => 'kyle@soberbrite.com',
        ]);
    }
}
