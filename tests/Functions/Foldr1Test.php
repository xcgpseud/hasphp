<?php

namespace Tests\Functions;

use Exception;
use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class Foldr1TestTest extends MainTestCase
{
    public function testIntsFoldr1Test(): void
    {
        $fnFold = fn(int $i, int $o): int => $i * $o;
        $fn = fn(array $in): int => Ints::with($in)->foldr1($fnFold);

        $this->expectException(Exception::class);
        Ints::with([])->foldr1($fnFold);

        TestBuilder::make()
            ->in([1])
            ->expect(1)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect(120)
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsFoldr1Test(): void
    {
        $fnFold = fn(string $a, string $b): string => $a . " " . $b;
        $fn = fn(array $in): string => Strings::with($in)->foldr1($fnFold);

        $this->expectException(Exception::class);
        Strings::with([])->foldr1($fnFold);

        TestBuilder::make()
            ->in(["hello"])
            ->expect("hello")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["hello", "world", "it", "is", "me"])
            ->expect("hello world it is me")
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsFoldr1Test(): void
    {
        $fnFold = fn(Person $a, Person $b): Person => $a->age > $b->age ? $a : $b;
        $fn = fn(array $in): Person => Objects::with($in)->foldr1($fnFold);

        [$one, $two] = $this->getFakePeopleWithAges([25, 30]);

        $this->expectException(Exception::class);
        Objects::with([])->foldr1($fnFold);

        TestBuilder::make()
            ->in([$one])
            ->expect($one)
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two])
            ->expect($two)
            ->fn($fn)
            ->runTestEquals();
    }
}