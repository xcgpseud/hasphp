<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class IntersperseTestTest extends MainTestCase
{
    public function testIntsIntersperseTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->intersperse(99)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect([1, 99, 2, 99, 3])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsIntersperseTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->intersperse("yo")->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "sup"])
            ->expect(["hello", "yo", "world", "yo", "sup"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsIntersperseTest(): void
    {
        [$one, $two, $three] = $this->getFakePeople(3);
        $fn = fn(array $in): array => Objects::with($in)->intersperse($three)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two])
            ->expect([$one, $three, $two])
            ->fn($fn)
            ->runTestEquals();
    }
}