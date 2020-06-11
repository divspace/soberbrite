<?php

use App\Database\LookupSeeder;
use App\Database\Models\City;

final class CitySeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup(City::TABLE))
            ->fetch()
            ->each(function ($city): void {
                $this->insertData->push([
                    City::NAME => $city[City::NAME],
                    City::CREATED_AT => $this->timestamp,
                    City::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insert(City::TABLE);
    }
}
