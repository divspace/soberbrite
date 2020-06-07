<?php

use App\Database\Models\City;
use Illuminate\Database\Seeder;

final class CitySeeder extends Seeder
{
    public function run(): void
    {
        (new Lookup('cities'))->get()->each(function (string $city): void {
            factory(City::class)->create([
                'name' => $city,
            ]);
        });
    }
}
