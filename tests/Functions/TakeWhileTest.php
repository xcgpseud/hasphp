<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class TakeWhileTestTest extends MainTestCase
{
    public function testIntsTakeWhileTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->takeWhile(fn(int $i): bool => $i < 3)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([5, 6, 7, 1, 2])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([1, 2])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsTakeWhileTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)
            ->takeWhile(fn(string $s): bool => $s === strtoupper($s))->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["not", "UPPER CASE"])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["UPPER", "CASE", "at last"])
            ->expect(["UPPER", "CASE"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsTakeWhileTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->takeWhile(fn(Person $x): bool => $x->age < 25)->get();

        [$one, $two, $three] = $this->getFakePeopleWithAges([20, 25, 30, 35]);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$two, $three, $one])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([$one])
            ->fn($fn)
            ->runTestEquals();
    }
}