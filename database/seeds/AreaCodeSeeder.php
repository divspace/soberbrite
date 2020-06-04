<?php

use App\Database\Models\AreaCode;
use App\Database\Models\State;
use Illuminate\Database\Seeder;

final class AreaCodeSeeder extends Seeder
{
    public function run(): void
    {
        (new LookupCollection())->getAreaCodes()->each(function ($areaCode): void {
            $state = State::where('code', $areaCode['stateCode'])->first();

            if (isset($state)) {
                factory(AreaCode::class)->create([
                    'state_id' => $state->id,
                    'code' => $areaCode['code'],
                ]);
            }
        });
    }
}
