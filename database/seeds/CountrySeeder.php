<?php

use App\Database\LookupSeeder;
use App\Database\Models\Country;
use App\Services\LookupService;

final class CountrySeeder extends LookupSeeder
{
    public function run(): void
    {
        (new LookupService(Country::TABLE))
            ->fetch()
            ->each(function (array $country): void {
                $this->insertData->push([
                    Country::CODE => strtoupper($country[Country::CODE]),
                    Country::NAME => $country[Country::NAME],
                    Country::CREATED_AT => $this->timestamp,
                    Country::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insert(Country::TABLE);
    }
}
