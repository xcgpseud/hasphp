<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class NubTestTest extends MainTestCase
{
    public function testIntsNubTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->nub()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 2, 1, 4])
            ->expect([1, 2, 3, 4])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsNubTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->nub()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "it", "it", "is", "me"])
            ->expect(["hello", "world", "it", "is", "me"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsNubTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->nub()->get();

        [$one, $two, $three] = $this->getFakePeople(3);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $two, $two, $three])
            ->expect([$one, $two, $three])
            ->fn($fn)
            ->runTestEquals();
    }
}