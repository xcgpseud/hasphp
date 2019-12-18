<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class AllTest extends MainTestCase
{
    public function testIntsAll(): void
    {
        $fn = fn (array $in): int => Ints::with($in)->all(fn (int $i): bool => $i % 2 == 0);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([2, 4, 6])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsAll(): void
    {
        $fn = fn (array $in): string => Strings::with($in)->all(fn (string $s): bool => $s === strtoupper($s));

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["not upper case", "at all"])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["only some", "UPPER", "cAsE"])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["ALL", "UPPER", "CASE, HERE"])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsAll(): void
    {
        $fn = fn (array $in): bool => Objects::with($in)->all(fn (Person $x): bool => $x->age == 20);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
            ])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 20),
                new Person("John", "Doe", 20),
            ])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }
}