<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class LengthTestTest extends MainTestCase
{
    public function testIntsLengthTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->length();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsLengthTest(): void
    {
        $fn = fn(array $in): int => Strings::with($in)->length();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsLengthTest(): void
    {
        $fn = fn(array $in): int => Objects::with($in)->length();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in($this->getFakePeople(5))
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();
    }
}