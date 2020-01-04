<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class InitTestTest extends MainTestCase
{
    public function testIntsInitTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->init()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([1, 2, 3, 4])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsInitTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->init()->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect(["hello", "world", "it", "is"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsInitTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->init()->get();

        [$one, $two, $three] = $this->getFakePeople(3);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([$one, $two])
            ->fn($fn)
            ->runTestEquals();
    }
}