<?php

namespace Tests\Feature;

use App\Services\LookupService;
use Tests\TestCase;

class LookupServiceTest extends TestCase
{
    /**
     * @test
     */
    public static function a_lookup_config_exists(): void
    {
        self::assertTrue(config()->has('lookup'));
    }

    /**
     * @test
     */
    public static function all_lookup_files_exist(): void
    {
        foreach (config('lookup.tables') as $lookup) {
            self::assertFileExists($lookup['file_path']);
        }
    }

    /**
     * @test
     */
    public static function has_fifty_states_and_one_district(): void
    {
        self::assertCount(51, (new LookupService('states'))->fetch()->toArray());
    }
}
