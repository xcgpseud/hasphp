<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class ElemTest extends MainTestCase
{
    public function testIntsElem(): void
    {
        $fn = fn(array $in): bool => Ints::with($in)->elem(2);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 4])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsElem(): void
    {
        $fn = fn(array $in): bool => Strings::with($in)->elem("world");

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "WORLD"])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world"])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsElem(): void
    {
        $chris = new Person("Chris", "Evans", 27);
        $fn = fn(array $in): bool => Objects::with($in)->elem($chris);

        TestBuilder::make()
            ->in([])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27), // Test no loose equality on objects (same as $chris)
                new Person("John", "Doe", 30),
            ])
            ->expect(false)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                $chris,
                new Person("John", "Doe", 30),
            ])
            ->expect(true)
            ->fn($fn)
            ->runTestEquals();
    }
}