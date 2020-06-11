<?php

use App\Database\LookupSeeder;
use App\Database\Models\State;

final class StateSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup(State::TABLE))
            ->fetch()
            ->map(function (array $state): void {
                $this->insertData->push([
                    State::CODE => $state[State::CODE],
                    State::NAME => $state[State::NAME],
                    State::CREATED_AT => $this->timestamp,
                    State::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insert(State::TABLE);
    }
}
