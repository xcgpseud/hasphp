<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use Tests\MainTestCase;
use Tests\TestBuilder;

class AverageTest extends MainTestCase
{
    public function testIntAverage(): void
    {
        $fn = fn (array $in): float => Ints::with($in)->average();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(3)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([-1, 0, 1])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 1.5, 2])
            ->expect(1.5)
            ->fn($fn)
            ->runTestEquals();
    }
}