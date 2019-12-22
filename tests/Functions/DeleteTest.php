<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class DeleteTest extends MainTestCase
{
    public function testIntsDelete(): void
    {
        $fn = fn (array $in): array => Ints::with($in)->delete(2)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 4, 5])
            ->expect([1, 3, 4, 5])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 2, 3, 4])
            ->expect([1, 2, 3, 4])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsDelete(): void
    {
        $fn = fn (array $in): array => Strings::with($in)->delete("hello")->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello is", "not", "here"])
            ->expect(["hello is", "not", "here"])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "is", "here", "hello"])
            ->expect(["is", "here", "hello"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsDelete(): void
    {
        $del = new Person("Chris", "Evans", 27);
        $fn = fn (array $in): array => Objects::with($in)->delete($del)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 90),
            ])
            ->expect([
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 90),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 90),
                new Person("Chris", "Evans", 27),
            ])
            ->expect([
                new Person("John", "Doe", 20),
                new Person("Jane", "Doe", 90),
                new Person("Chris", "Evans", 27),
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}