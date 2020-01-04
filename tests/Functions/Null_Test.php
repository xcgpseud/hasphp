<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class Null_TestTest extends MainTestCase
{
    public function testIntsNull_Test(): void
    {
        $fn = fn(array $in): bool => Ints::with($in)->null_();

        TestBuilder::make()
            ->in([])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsNull_Test(): void
    {
        $fn = fn(array $in): bool => Strings::with($in)->null_();

        TestBuilder::make()
            ->in([])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it's", "me"])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsNull_Test(): void
    {
        $fn = fn(array $in): bool => Objects::with($in)->null_();

        TestBuilder::make()
            ->in([])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in($this->getFakePeople(3))
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();
    }
}