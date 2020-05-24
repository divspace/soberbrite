<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ZipCodeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProgramSeeder::class);
    }
}
