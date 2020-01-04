<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class HeadTestTest extends MainTestCase
{
    public function testIntsHeadTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->head();

        TestBuilder::make()
            ->in([])
            ->expect(0)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(1)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsHeadTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)->head();

        TestBuilder::make()
            ->in([])
            ->expect("")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect("hello")
            ->fn($fn)
            ->runTestEquals();

    }

    public function testObjectsHeadTest(): void
    {
        $fn = fn(array $in): ?Person => Objects::with($in)->head();

        [$one, $two, $three] = $this->getFakePeople(3);

        TestBuilder::make()
            ->in([])
            ->expect(null)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect($one)
            ->fn($fn)
            ->runTestEquals();

    }
}