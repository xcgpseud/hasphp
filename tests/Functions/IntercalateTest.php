<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class IntercalateTestTest extends MainTestCase
{
    public function testIntsIntercalateTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->intercalate([
            [1, 2],
            [3, 4],
        ])->get();

        TestBuilder::make()
            ->in([])
            ->expect([1, 2, 3, 4])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([9, 9])
            ->expect([1, 2, 9, 9, 3, 4])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsIntercalateTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->intercalate([
            ["hello", "world"],
            ["it's", "me"],
        ])->get();

        TestBuilder::make()
            ->in([])
            ->expect(["hello", "world", "it's", "me"])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["yo", "yo"])
            ->expect(["hello", "world", "yo", "yo", "it's", "me"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsIntercalateTest(): void
    {
        $chris = new Person("Chris", "Evans", 27);
        $john = new Person("John", "Doe", 30);

        $fn = fn(array $in): array => Objects::with($in)->intercalate([
            [$chris, $john],
            [$john, $chris],
        ])->get();

        TestBuilder::make()
            ->in([])
            ->expect([$chris, $john, $john, $chris])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$chris, $chris])
            ->expect([$chris, $john, $chris, $chris, $john, $chris])
            ->fn($fn)
            ->runTestEquals();
    }
}