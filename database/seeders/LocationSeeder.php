<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Database\LookupSeeder;
use App\Database\Models\City;
use App\Database\Models\Location;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use App\Services\LookupService;

final class LocationSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new LookupService(Location::TABLE))
            ->fetch()
            ->each(function (array $location): void {
                $city = City::where(City::NAME, $location['city'])->first();
                $state = State::where(State::CODE, $location['state'])->first();
                $zipCode = ZipCode::where(ZipCode::CODE, $location['zip_code'])->first();

                if (isset($city, $state, $zipCode)) {
                    $this->insertData->push([
                        Location::CITY => $city->id,
                        Location::STATE => $state->id,
                        Location::ZIP_CODE => $zipCode->id,
                        Location::LATITUDE => $location[Location::LATITUDE],
                        Location::LONGITUDE => $location[Location::LONGITUDE],
                        Location::TIMEZONE_OFFSET => $location[Location::TIMEZONE_OFFSET].':00:00',
                        Location::OBSERVES_DST => $location[Location::OBSERVES_DST],
                        Location::CREATED_AT => $this->timestamp,
                        Location::UPDATED_AT => $this->timestamp,
                    ]);
                }
            });

        $this->insertInChunks(Location::TABLE);
    }
}
