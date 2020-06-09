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
        $states = (new Lookup('states'))->get()->pluck('code')->toArray();

        $this->insertData = (new Lookup('locations'))
            ->get()
            ->filter(static function (array $location) use ($states): bool {
                return in_array($location['stateCode'], $states, true);
            })
            ->transform(function (array $location): ?array {
                $city = City::where('name', $location['cityName'])->pluck('id')->first();
                $state = State::where('code', $location['stateCode'])->pluck('id')->first();
                $zipCode = ZipCode::where('code', $location['zipCode'])->pluck('id')->first();

                if (isset($city, $state, $zipCode)) {
                    return [
                        Location::CITY => $city,
                        Location::STATE => $state,
                        Location::ZIP_CODE => $zipCode,
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
