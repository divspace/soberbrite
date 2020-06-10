<?php

use App\Database\LookupSeeder;
use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;

final class LocationSeeder extends LookupSeeder
{
    public function run(): void
    {
        $this->insertData = (new Lookup('locations'))
            ->get()
            ->transform(function (array $location): ?array {
                $city = City::where('name', $location['cityName'])->first();
                $state = State::where('code', $location['stateCode'])->first();
                $zipCode = ZipCode::where('code', $location['zipCode'])->first();

                if (isset($city, $state, $zipCode)) {
                    return [
                        Location::CITY => $city->id,
                        Location::STATE => $state->id,
                        Location::ZIP_CODE => $zipCode->id,
                        Location::LATITUDE => $location['latitude'],
                        Location::LONGITUDE => $location['longitude'],
                        Location::TIMEZONE_OFFSET => $location['timezoneOffset'].':00:00',
                        Location::OBSERVES_DST => $location['observesDst'],
                        Location::CREATED_AT => $this->timestamp,
                        Location::UPDATED_AT => $this->timestamp,
                    ];
                }

                return null;
            });

        $this->insertInChunks(Location::TABLE);
    }
}
