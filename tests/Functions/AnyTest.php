<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class AnyTest extends MainTestCase
{
    public function testIntsAny(): void
    {
        $fn = fn (array $in): bool => Ints::with($in)->any(fn (int $i): bool => $i % 2 == 0);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 5, 7, 9])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsAny(): void
    {
        $fn = fn (array $in): bool => Strings::with($in)->any(fn (string $s): bool => $s === strtoupper($s));

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["no", "upper case"])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["SOME", "upper case"])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsAny(): void
    {
        $fn = fn (array $in): bool => Objects::with($in)->any(fn (Person $x): bool => $x->age == 20);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 99),
            ])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
            ])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }
}