<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\TestBuilder;

class TakeTestTest extends MainTestCase
{
    public function testIntsTakeTest(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->take(3)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([1, 2, 3])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect([1, 2, 3])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1])
            ->expect([1])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsTakeTest(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->take(3)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect(["hello", "world", "it"])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it"])
            ->expect(["hello", "world", "it"])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello"])
            ->expect(["hello"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsTakeTest(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->take(3)->get();

        [$one, $two, $three, $four, $five] = $this->getFakePeople(5);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three, $four, $five])
            ->expect([$one, $two, $three])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([$one, $two, $three])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one])
            ->expect([$one])
            ->fn($fn)
            ->runTestEquals();
    }
}