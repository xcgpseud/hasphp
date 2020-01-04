<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class MinimumByTestTest extends MainTestCase
{
    public function testIntsMinimumByTest(): void
    {
        $fn = fn(array $in): int => Ints::with($in)->minimumBy(fn(int $i, int $o): int => $i < $o ? $i : $o);

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

    public function testStringsMinimumByTest(): void
    {
        $fn = fn(array $in): string => Strings::with($in)
            ->minimumBy(fn(string $a, string $b): string => strcmp($a, $b) < 0 ? $a : $b);

        TestBuilder::make()
            ->in([])
            ->expect("")
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["a", "z"])
            ->expect("a")
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsMinimumByTest(): void
    {
        $fn = fn(array $in): ?Person => Objects::with($in)
            ->minimumBy(fn(Person $a, Person $b): Person => $a->age < $b->age ? $a : $b);

        [$one, $two, $three] = $this->getFakePeopleWithAges([20, 30, 40]);

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