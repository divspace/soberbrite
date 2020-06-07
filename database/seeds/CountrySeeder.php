<?php

use App\Database\Models\Country;
use Illuminate\Database\Seeder;

final class CountrySeeder extends Seeder
{
    public function run(): void
    {
        (new Lookup('countries'))->get()->each(function (array $country): void {
            factory(Country::class)->create([
                'code' => strtoupper($country['code']),
                'name' => $country['name'],
            ]);
        });
    }
}
