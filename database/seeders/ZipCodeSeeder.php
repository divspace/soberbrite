<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Database\LookupSeeder;
use App\Database\Models\ZipCode;
use App\Services\LookupService;

final class ZipCodeSeeder extends LookupSeeder
{
    public function run(): void
    {
        (new LookupService(ZipCode::TABLE))
            ->fetch()
            ->map(function (array $zipCode): void {
                $this->insertData->push([
                    ZipCode::CODE => $zipCode[ZipCode::CODE],
                    ZipCode::CREATED_AT => $this->timestamp,
                    ZipCode::UPDATED_AT => $this->timestamp,
                ]);
            });

        $this->insertInChunks(ZipCode::TABLE, 5000);
    }
}
