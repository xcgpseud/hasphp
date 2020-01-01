<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class FilterTestTest extends MainTestCase
{
    public function testIntsFilterTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->filter(fn(int $i): bool => $i % 2 == 0)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 5])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5, 6])
            ->expect([2, 4, 6])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsFilterTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->filter(fn(string $s): bool => $s === strtoupper($s))->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["all", "lower", "case"])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["lower", "bOtH", "FULLY", "UPPER"])
            ->expect(["FULLY", "UPPER"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsFilterTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->filter(fn(Person $x): bool => $x->age > 18)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Child", "One", 5),
                new Person("John", "Kidd", 7),
            ])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Child", "One", 5),
                new Person("Adult", "One", 20),
                new Person("John", "Kidd", 7),
                new Person("Chris", "Evans", 27),
            ])
            ->expect([
                new Person("Adult", "One", 20),
                new Person("Chris", "Evans", 27),
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}