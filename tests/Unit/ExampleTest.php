<?php

declare(strict_types = 1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public static function true_is_true(): void
    {
        self::assertTrue(true);
    }
}
