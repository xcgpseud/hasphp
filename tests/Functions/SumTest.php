<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use Tests\MainTestCase;
use Tests\TestBuilder;

class SumTest extends MainTestCase
{
    public function testIntsSum(): void
    {
        $fn = fn (array $in): int => Ints::with($in)->sum();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(15)
            ->fn($fn)
            ->runTestEquals();
    }
}