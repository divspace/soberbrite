<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class CitySeeder extends Seeder
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
        $this->insertData = (new Lookup('cities'))
            ->fetch()
            ->transform(function (array $city): array {
                return [
                    'name' => $city['name'],
                    'created_at' => $this->timestamp,
                    'updated_at' => $this->timestamp,
                ];
            });

        DB::transaction(function (): void {
            foreach ($this->insertData->chunk(5000) as $chunk) {
                DB::table('cities')->insert($chunk->toArray());
            }
        });
    }
}
