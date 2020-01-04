<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class DropWhileTest extends MainTestCase
{
    public function testIntsDropWhile(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->dropWhile(fn(int $i): bool => $i % 2 == 0)->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([2, 4, 5, 6, 7])
            ->expect([5, 6, 7])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsDropWhile(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->dropWhile(
            fn(string $s): bool => strtoupper($s) === $s
        )->get();

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["UPPER", "CASE", "not", "UPPER", "again"])
            ->expect(["not", "UPPER", "again"])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsDropWhile(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->dropWhile(fn(Person $x): bool => $x->age % 2 == 0)->get();

        [$one, $two, $three, $four] = $this->getFakePeopleWithAges([20, 30, 25, 35]);

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three, $four])
            ->expect([$three, $four])
            ->fn($fn)
            ->runTestEquals();
    }
}