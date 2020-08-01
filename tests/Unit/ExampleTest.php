<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public static function true_is_true(): void
    {
        static::assertTrue(true);
    }
}
