<?php

use App\Database\LookupSeeder;
use App\Database\Models\Program;
use App\Database\Models\ProgramType;

final class ProgramSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup(Program::TABLE))
            ->fetch()
            ->each(function (array $programs, string $type): void {
                $programTypeId = DB::table(ProgramType::TABLE)->insertGetId([
                    ProgramType::NAME => Str::of($type)->singular(),
                    ProgramType::CREATED_AT => $this->timestamp,
                    ProgramType::UPDATED_AT => $this->timestamp,
                ]);

                foreach ($programs as $program) {
                    $this->insertData->push([
                        Program::TYPE => $programTypeId,
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
