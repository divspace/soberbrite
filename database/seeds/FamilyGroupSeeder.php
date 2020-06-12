<?php

use App\Database\LookupSeeder;
use App\Database\Models\FamilyGroup;

final class FamilyGroupSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new Lookup(FamilyGroup::TABLE))
            ->fetch()
            ->sortBy('name')
            ->each(function (array $group): void {
                $this->insertData->push([
                    FamilyGroup::NAME => $group[FamilyGroup::NAME],
                    FamilyGroup::ABBREVIATION => $group[FamilyGroup::ABBREVIATION] ?? null,
                    FamilyGroup::CREATED_AT => $this->timestamp,
                    FamilyGroup::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insert(FamilyGroup::TABLE);
    }
}
