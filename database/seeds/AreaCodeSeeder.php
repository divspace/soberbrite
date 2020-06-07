<?php

use App\Database\Models\AreaCode;
use App\Database\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

final class AreaCodeSeeder extends Seeder
{
    public function run(): void
    {
        (new Lookup('areaCodes'))->get()->each(function (Collection $areaCodes, string $stateCode): void {
            $state = State::where('code', $stateCode)->first();

            if (isset($state)) {
                $areaCodes->each(function (string $code) use ($state): void {
                    factory(AreaCode::class)->create([
                        'state_id' => $state->id,
                        'code' => $code,
                    ]);
                });
            }
        });
    }
}
