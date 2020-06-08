<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class ZipCodeSeeder extends Seeder
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
        $this->insertData = (new Lookup('zipCodes'))
            ->get()
            ->transform(function (array $zipCode): array {
                return [
                    'code' => $zipCode['code'],
                    'created_at' => $this->timestamp,
                    'updated_at' => $this->timestamp,
                ];
            });

        DB::transaction(function (): void {
            foreach ($this->insertData->chunk(5000) as $chunk) {
                DB::table('zip_codes')->insert($chunk->toArray());
            }
        });
    }
}
