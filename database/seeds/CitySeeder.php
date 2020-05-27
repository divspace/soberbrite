<?php

use App\Database\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = (new FileToCollection)
            ->getLocations()
            ->pluck('cityName')
            ->unique()
            ->sort();

        $cities->each(function ($city) {
            factory(City::class)->create([
                'name' => $city,
            ]);
        });
    }
}
