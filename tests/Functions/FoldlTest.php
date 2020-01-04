<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class FoldlTestTest extends MainTestCase
{
    public function testIntsFoldlTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->foldl(fn(int $i, int $o): int => $i * $o, 5);

        TestBuilder::make()
            ->in([])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1])
            ->expect(5)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(600)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsFoldlTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)
            ->foldl(fn(string $a, string $b): string => $a . " " . $b, "hello");

        TestBuilder::make()
            ->in([])
            ->expect("hello")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["world"])
            ->expect("hello world")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["world", "it", "is", "me"])
            ->expect("hello world it is me")
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsFoldlTest(): void
    {
        [$init, $one, $two] = $this->getFakePeopleWithAges([25, 90, 100]);
        $fn = fn(array $in): Person => Objects::with($in)
            ->foldl(fn(Person $a, Person $b): Person => $a->age > $b->age ? $a : $b, $init);

        TestBuilder::make()
            ->in([])
            ->expect($init)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$two])
            ->expect($two)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two])
            ->expect($two)
            ->fn($fn)
            ->runTestEquals();
    }
}