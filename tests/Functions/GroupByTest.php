<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class GroupByTestTest extends MainTestCase
{
    public function testIntsGroupByTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->groupBy(fn(int $i, int $o): bool => ($i * $o) % 3 == 0)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5, 6, 7, 8, 9])
            ->expect([
                Ints::with([1]),
                Ints::with([2, 3]),
                Ints::with([4]),
                Ints::with([5, 6]),
                Ints::with([7]),
                Ints::with([8, 9]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsGroupByTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)
            ->groupBy(fn(string $a, string $b): bool => ctype_alpha($b))->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["should", "spl1t", "that", "and", "this", "1"])
            ->expect([
                Strings::with(["should"]),
                Strings::with(["spl1t", "that", "and", "this"]),
                Strings::with(["1"]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsGroupByTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)
            ->groupBy(fn(Person $a, Person $b): bool => $b->age > 20)->get();

        [$one, $two, $three, $four] = $this->getFakePeopleWithAges([25, 10, 30, 5]);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three, $four])
            ->expect([
                Objects::with([$one]),
                Objects::with([$two, $three]),
                Objects::with([$four]),
            ])
            ->fn($fn)
            ->runTestEquals();

    }
}