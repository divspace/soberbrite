<?php

use App\Database\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection)->getCountries()->each(function ($country) {
            factory(Country::class)->create([
                'code' => $country['code'],
                'name' => $country['name'],
            ]);
        });
    }
}
