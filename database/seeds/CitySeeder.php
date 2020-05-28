<?php

use App\Database\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        (new FileToCollection)->getCities()->each(function ($city) {
            factory(City::class)->create([
                'name' => $city,
            ]);
        });
    }
}
