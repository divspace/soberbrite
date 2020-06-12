<?php

use App\Database\LookupSeeder;
use App\Database\Models\RecoveryProgram;

final class RecoveryProgramSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup(RecoveryProgram::TABLE))
            ->fetch()
            ->sortBy('name')
            ->each(function (array $program): void {
                $this->insertData->push([
                    RecoveryProgram::NAME => $program[RecoveryProgram::NAME],
                    RecoveryProgram::ABBREVIATION => $program[RecoveryProgram::ABBREVIATION] ?? null,
                    RecoveryProgram::CREATED_AT => $this->timestamp,
                    RecoveryProgram::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insert(RecoveryProgram::TABLE);
    }
}
