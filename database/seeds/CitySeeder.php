<?php

use App\Database\Models\City;
use Illuminate\Database\Seeder;

final class CitySeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection())->getCities()->each(function ($city): void {
            factory(City::class)->create([
                'name' => $city,
            ]);
        });
    }
}
