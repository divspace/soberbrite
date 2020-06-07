<?php

use App\Database\Models\City;
use App\Database\Models\State;
use App\Database\Models\ZipCode;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class LocationSeeder extends Seeder
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
        $states = (new Lookup('states'))->get()->pluck('code')->toArray();

        $this->insertData = (new Lookup('locations'))
            ->get()
            ->filter(function (array $location) use ($states): bool {
                return in_array($location['stateCode'], $states, true);
            })
            ->transform(function (array $location): array {
                $city = City::where('name', $location['cityName'])->pluck('id')->first();
                $state = State::where('code', $location['stateCode'])->pluck('id')->first();
                $zipCode = ZipCode::where('code', $location['zipCode'])->pluck('id')->first();

                if (isset($city, $state, $zipCode)) {
                    return [
                        'city_id' => $city,
                        'state_id' => $state,
                        'zip_code_id' => $zipCode,
                        'latitude' => $location['latitude'],
                        'longitude' => $location['longitude'],
                        'timezone_offset' => $location['timezoneOffset'].':00:00',
                        'observes_dst' => $location['observesDst'],
                        'created_at' => $this->timestamp,
                        'updated_at' => $this->timestamp,
                    ];
                }
            });

        DB::transaction(function (): void {
            foreach ($this->insertData->chunk(100) as $chunk) {
                DB::table('locations')->insert($chunk->toArray());
            }
        });
    }
}
