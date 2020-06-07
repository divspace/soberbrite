<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class StateSeeder extends Seeder
{
    private Carbon $timestamp;

    private Collection $insertData;

    public function __construct() {
        $this->timestamp = Carbon::now();
    }

    public function __destruct()
    {
        unset($this->insertData);
    }

    public function run(): void
    {
        $this->insertData = (new Lookup('states'))
            ->get()
            ->transform(function (array $state): array {
                return [
                    'code' => $state['code'],
                    'name' => $state['name'],
                    'created_at' => $this->timestamp,
                    'updated_at' => $this->timestamp,
                ];
            });

        DB::table('states')->insert($this->insertData->toArray());
    }
}
