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
        (new Lookup('locations'))
            ->fetch()
            ->each(function (array $location): void {
                $city = City::where('name', $location['cityName'])->first();
                $state = State::where('code', $location['stateCode'])->first();
                $zipCode = ZipCode::where('code', $location['zipCode'])->first();

                if (isset($city, $state, $zipCode)) {
                    $this->insertData->push([
                        Location::CITY => $city->id,
                        Location::STATE => $state->id,
                        Location::ZIP_CODE => $zipCode->id,
                        Location::LATITUDE => $location[Location::LATITUDE],
                        Location::LONGITUDE => $location[Location::LONGITUDE],
                        Location::TIMEZONE_OFFSET => $location['timezoneOffset'].':00:00',
                        Location::OBSERVES_DST => $location['observesDst'],
                        Location::CREATED_AT => $this->timestamp,
                        Location::UPDATED_AT => $this->timestamp,
                    ]);
                }
            });

        $this->insertInChunks(Location::TABLE);
    }
}
