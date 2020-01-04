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

        [$one, $two, $three] = $this->getFakePeople(3);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([$two, $three])
            ->fn($fn)
            ->runTestEquals();
    }
}