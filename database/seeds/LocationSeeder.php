<?php

use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection)->getLocations()->each(function ($location): void {
            $city = City::where('name', $location['cityName'])->first();
            $state = State::where('code', $location['stateCode'])->first();
            $zipCode = ZipCode::where('code', $location['zipCode'])->first();

            if (isset($city, $state, $zipCode)) {
                factory(Location::class)->create([
                    'city_id' => $city->id,
                    'state_id' => $state->id,
                    'zip_code_id' => $zipCode->id,
                    'coordinate' => new Point($location['latitude'], $location['longitude']),
                    'timezone_offset' => $location['timezoneOffset'].':00:00',
                    'observes_dst' => $location['observesDst'],
                ]);
            }
        });
    }
}
