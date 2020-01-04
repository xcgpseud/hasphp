<?php

namespace Tests\Functions;

use Exception;
use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class Foldl1TestTest extends MainTestCase
{
    public function testIntsFoldl1Test(): void
    {
        $fnFold = fn(int $i, int $o): int => $i * $o;
        $fn = fn(array $in): int => Ints::with($in)->foldl1($fnFold);

        $this->expectException(Exception::class);
        Ints::with([])->foldl1($fnFold);

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

    public function testStringsFoldl1Test(): void
    {
        $fnFold = fn(string $a, string $b): string => $a . " " . $b;
        $fn = fn(array $in): string => Strings::with($in)->foldl1($fnFold);

        $this->expectException(Exception::class);
        Strings::with([])->foldl1($fnFold);

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

    public function testObjectsFoldl1Test(): void
    {
        $fnFold = fn(Person $a, Person $b): Person => $a->age > $b->age ? $a : $b;
        $fn = fn(array $in): Person => Objects::with($in)->foldl1($fnFold);

        [$one, $two] = $this->getFakePeopleWithAges([20, 30]);

        $this->expectException(Exception::class);
        Objects::with([])->foldl1($fnFold);

        TestBuilder::make()
            ->in([$one])
            ->expect([$one])
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two])
            ->expect([$two])
            ->fn($fn)
            ->runTestEquals();
    }
}