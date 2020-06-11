<?php

use App\Database\Models\State;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class AreaCodeSeeder extends Seeder
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
        $states = State::all();

        $this->insertData = new Collection();

        (new Lookup('areaCodes'))
            ->fetch()
            ->each(function (Collection $areaCodes, string $stateCode) use ($states): void {
                $state = $states->where('code', $stateCode)->first();

                if (isset($state)) {
                    $areaCodes->each(function (string $areaCode) use ($state): void {
                        $this->insertData[] = [
                            'state_id' => $state->id,
                            'code' => $areaCode,
                            'created_at' => $this->timestamp,
                            'updated_at' => $this->timestamp,
                        ];
                    });
                }
            });

        DB::table('area_codes')->insert($this->insertData->toArray());
    }
}
