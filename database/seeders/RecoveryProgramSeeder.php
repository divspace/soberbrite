<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Database\LookupSeeder;
use App\Database\Models\RecoveryProgram;
use App\Services\LookupService;

final class RecoveryProgramSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new LookupService(RecoveryProgram::TABLE))
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
