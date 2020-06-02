<?php

use App\Database\Models\AreaCode;
use App\Database\Models\State;
use Illuminate\Database\Seeder;

class AreaCodeSeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection)->getAreaCodes()->each(function ($areaCode) {
            $state = State::where('code', $areaCode['stateCode'])->first();

            if ($state) {
                factory(AreaCode::class)->create([
                    'state_id' => $state->id,
                    'code' => $areaCode['code'],
                ]);
            } else {
                Log::info('State '.$areaCode['stateCode'].' not found for area code '.$areaCode['code']);
            }
        });
    }
}
