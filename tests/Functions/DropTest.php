<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class DropTest extends MainTestCase
{
    public function testIntsDrop(): void
    {
        $fn = fn (array $in): array => Ints::with($in)->drop(2)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([3, 4, 5])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsDrop(): void
    {
        $fn = fn (array $in): array => Strings::with($in)->drop(2)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world"])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "how", "are", "you?"])
            ->expect(["how", "are", "you?"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsDrop(): void
    {
        $fn = fn (array $in): array => Objects::with($in)->drop(2)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 90),
            ])
            ->expect([
                new Person("Jane", "Doe", 90),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();
    }
}