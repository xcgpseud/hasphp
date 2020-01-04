<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class GroupTestTest extends MainTestCase
{
    public function testIntsGroupTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->group()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 2, 1, 1, 1, 2, 2, 2, 1])
            ->expect([
                Ints::with([1]),
                Ints::with([2, 2]),
                Ints::with([1, 1, 1]),
                Ints::with([2, 2, 2]),
                Ints::with([1]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsGroupTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->group()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "world", "hello", "hello"])
            ->expect([
                Strings::with(["hello"]),
                Strings::with(["world", "world"]),
                Strings::with(["hello", "hello"]),
            ])
            ->fn($fn)
            ->runTestEquals();

    }

    public function testObjectsGroupTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->group()->get();

        [$one, $two] = $this->getFakePeopleWithAges([27, 30]);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $two, $one, $one, $two])
            ->expect([
                Objects::with([$one]),
                Objects::with([$two, $two]),
                Objects::with([$one, $one]),
                Objects::with([$two]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}