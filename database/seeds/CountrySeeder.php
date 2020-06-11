<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class CountrySeeder extends Seeder
{
    private Carbon $timestamp;

    private Collection $insertData;

    public function __construct()
    {
        $this->timestamp = Carbon::now();
    }

    public function __destruct()
    {
        unset($this->insertData);
    }

    public function run(): void
    {
        $this->insertData = (new Lookup('countries'))
            ->fetch()
            ->transform(function (array $country): array {
                return [
                    'code' => strtoupper($country['code']),
                    'name' => $country['name'],
                    'created_at' => $this->timestamp,
                    'updated_at' => $this->timestamp,
                ];
            });

        DB::table('countries')->insert($this->insertData->toArray());
    }
}
