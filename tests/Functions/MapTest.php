<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class MapTest extends MainTestCase
{
    public function testIntsMap(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->map(fn(int $i): int => $i * 2)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3, 4, 5])
            ->expect([2, 4, 6, 8, 10])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsMap(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->map(fn(string $x): string => strrev($x))->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["one", "two", "three"])
            ->expect(["eno", "owt", "eerht"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsMap(): void
    {
        $objFn = function (Person $x): Person {
            $x->age *= 2;
            return $x;
        };
        $fn = fn(array $in): array => Objects::with($in)->map($objFn)->get();

        [$one, $two] = $this->getFakePeopleWithAges([20, 30]);
        $oneAfter = $this->getNewFakePersonWithAge($one, 40);
        $twoAfter = $this->getNewFakePersonWithAge($two, 60);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two])
            ->expect([$oneAfter, $twoAfter])
            ->fn($fn)
            ->runTestEquals();
    }
}