<?php

namespace Tests\Feature;

use App\Services\LookupService;
use Tests\TestCase;

class LookupServiceTest extends TestCase
{
    public function testHasLookupConfig(): void
    {
        static::assertTrue(config()->has('lookup'));
    }

    public function testHasLookupFiles(): void
    {
        foreach (config('lookup.tables') as $lookup) {
            static::assertFileExists($lookup['file_path']);
        }
    }

    public function testHasFiftyOneStates(): void
    {
        static::assertCount(51, (new LookupService('states'))->fetch()->toArray());
    }
}
