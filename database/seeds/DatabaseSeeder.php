<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!App::environment('production')) {
            $this->call(UserSeeder::class);
            $this->call(ProfileSeeder::class);
            $this->call(ProgramSeeder::class);
        }
    }
}
