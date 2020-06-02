<?php

use App\Database\Models\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (!DB::table('cities')->count()) {
            $this->call(CitySeeder::class);
        }

        if (!DB::table('states')->count()) {
            $this->call(StateSeeder::class);
        }

        if (!DB::table('zip_codes')->count()) {
            $this->call(ZipCodeSeeder::class);
        }

        if (!DB::table('countries')->count()) {
            $this->call(CountrySeeder::class);
        }

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
