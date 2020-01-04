<?php

namespace Tests\Functions;

use HasPhp\Functions\Inits;
use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class InitsTestTest extends MainTestCase
{
    public function testIntsInitsTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->inits()->get();

        TestBuilder::make()
            ->in([])
            ->expect([
                Ints::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect([
                Ints::with([]),
                Ints::with([1]),
                Ints::with([1, 2]),
                Ints::with([1, 2, 3]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsInitsTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->inits()->get();

        TestBuilder::make()
            ->in([])
            ->expect([
                Strings::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect([
                Strings::with([]),
                Strings::with(["hello"]),
                Strings::with(["hello", "world"]),
                Strings::with(["hello", "world", "it"]),
                Strings::with(["hello", "world", "it", "is"]),
                Strings::with(["hello", "world", "it", "is", "me"]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsInitsTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->inits()->get();

        [$one, $two, $three] = $this->getFakePeople(3);

        TestBuilder::make()
            ->in([])
            ->expect([
                Objects::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([
                Objects::with([]),
                Objects::with([$one]),
                Objects::with([$one, $two]),
                Objects::with([$one, $two, $three]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}