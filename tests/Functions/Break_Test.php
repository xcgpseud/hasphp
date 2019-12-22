<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class Break_Test extends MainTestCase
{
    public function testIntsBreak_(): void
    {
        $fn = fn (array $in): array => Ints::with($in)->break_(fn (int $i): bool => $i % 2 == 0);

        TestBuilder::make()
            ->in([])
            ->expect([[], []])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 5, 6, 7, 8])
            ->expect([[1, 3, 5], [6, 7, 8]])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsBreak_(): void
    {
        $fn = fn (array $in): array => Strings::with($in)->break_(fn (string $s): bool => $s === strtoupper($s));

        TestBuilder::make()
            ->in([])
            ->expect([[], []])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["lower", "also lower", "Half Upper", "ALL UPPER", "lower again"])
            ->expect([["lower", "also lower", "Half Upper"], ["ALL UPPER", "lower again"]])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsBreak_(): void
    {
        $fn = fn (array $in): array => Objects::with($in)->break_(fn (Person $x): bool => $x->age == 20);

        TestBuilder::make()
            ->in([])
            ->expect([[], []])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 99),
            ])
            ->expect([
                [
                    new Person("Chris", "Evans", 27),
                ],
                [
                    new Person("John", "Doe", 20),
                    new Person("Jane", "Doe", 99),
                ],
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}