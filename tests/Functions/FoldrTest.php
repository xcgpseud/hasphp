<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class FoldrTestTest extends MainTestCase
{
    public function testIntsFoldrTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->foldr(fn(int $i, int $o): int => $i * $o, 5);

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

    public function testStringsFoldrTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)
            ->foldr(fn(string $a, string $b): string => $a . " " . $b, "hello");

        TestBuilder::make()
            ->in([])
            ->expect("hello")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["world"])
            ->expect("world hello")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["world", "it", "is", "me"])
            ->expect("world it is me hello")
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsFoldrTest(): void
    {
        [$init, $one, $two] = $this->getFakePeopleWithAges([25, 30, 35]);
        $fn = fn(array $in): Person => Objects::with($in)
            ->foldr(fn(Person $a, Person $b): Person => $a->age > $b->age ? $a : $b, $init);;

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