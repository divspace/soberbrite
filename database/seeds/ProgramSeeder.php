<?php

use App\Database\LookupSeeder;
use App\Database\Models\Program;

final class ProgramSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup('programs'))
            ->fetch()
            ->each(function (array $programs, string $type): void {
                foreach ($programs as $program) {
                    $this->insertData->push([
                        Program::TYPE => $type === 'recovery_programs' ? 1 : 2,
                        Program::NAME => $program[Program::NAME],
                        Program::ABBREVIATION => $program[Program::ABBREVIATION] ?? null,
                        Program::CREATED_AT => $this->timestamp,
                        Program::UPDATED_AT => $this->timestamp,
                    ]);
                }
            });

        $this->insert(Program::TABLE);
    }
}
