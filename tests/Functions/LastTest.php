<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class LastTestTest extends MainTestCase
{
    public function testIntsLastTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->last();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsLastTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)->last();

        TestBuilder::make()
            ->in([])
            ->expect("")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect("me")
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsLastTest(): void
    {
        $fn = fn(array $in): ?Person => Objects::with($in)->last();

        $chris = new Person("Chris", "Evans", 27);
        $john = new Person("John", "Doe", 30);

        TestBuilder::make()
            ->in([])
            ->expect(null)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$chris, $john, $chris, $john])
            ->expect($john)
            ->fn($fn)
            ->runTestEquals();
    }
}