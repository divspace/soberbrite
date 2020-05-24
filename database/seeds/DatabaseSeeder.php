<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!DB::table('locations')->count()) {
            $this->call(LocationSeeder::class);
        }

       if (!DB::table('programs')->count()) {
            $this->call(ProgramSeeder::class);
        }

        if (!DB::table('users')->count()) {
            $this->call(UserSeeder::class);
        }
    }
}
