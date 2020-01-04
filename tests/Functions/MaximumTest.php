<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class MaximumTestTest extends MainTestCase
{
    public function testIntsMaximumTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->maximum();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5, 4, 3, 2, 1])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsMaximumTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)->maximum();

        TestBuilder::make()
            ->in([])
            ->expect("")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["a", "b", "z", "b", "a"])
            ->expect("z")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "zello"])
            ->expect("zello")
            ->fn($fn)
            ->runTestEquals();
    }
}