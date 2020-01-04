<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class MinimumTestTest extends MainTestCase
{
    public function testIntsMinimumTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->minimum();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5, 4, 3, 2, 1])
            ->expect(1)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsMinimumTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)->minimum();

        TestBuilder::make()
            ->in([])
            ->expect("")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["a", "world", "it", "is", "me", "hello"])
            ->expect("a")
            ->fn($fn)
            ->runTestEquals();
    }
}