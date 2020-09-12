<?php

declare(strict_types = 1);

use App\Database\LookupSeeder;
use App\Database\Models\AreaCode;
use App\Database\Models\State;
use App\Services\LookupService;
use Illuminate\Support\Collection;

final class AreaCodeSeeder extends LookupSeeder
{
    public function run(): void
    {
        $states = State::all('id', 'code');

        (new LookupService(AreaCode::TABLE))
            ->fetch()
            ->each(function (Collection $areaCodes, string $stateCode) use ($states): void {
                $state = $states->where(State::CODE, $stateCode)->first();

                if (isset($state)) {
                    $areaCodes->each(function (string $areaCode) use ($state): void {
                        $this->insertData->push([
                            AreaCode::STATE => $state->id,
                            AreaCode::CODE => $areaCode,
                            AreaCode::CREATED_AT => $this->timestamp,
                            AreaCode::UPDATED_AT => $this->timestamp,
                        ]);
                    });
                }
            });

        $this->insert(AreaCode::TABLE);
    }
}
