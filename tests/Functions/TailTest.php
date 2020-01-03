<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class TailTestTest extends MainTestCase
{
    public function testIntsTailTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->tail()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([2, 3, 4, 5])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsTailTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->tail()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect(["world", "it", "is", "me"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsTailTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->tail()->get();

        $chris = new Person("Chris", "Evans", 27);
        $john = new Person("John", "Doe", 30);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$chris, $john, $chris])
            ->expect([$john, $chris])
            ->fn($fn)
            ->runTestEquals();
    }
}