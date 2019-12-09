<?php

namespace Tests\Functions;

use Exception;
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
        $fn = function ($v) {
            return Ints::with($v)->map(function (int $x) { return $x * 2; })->get();
        };

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
        $fn = function ($v) {
            return Strings::with($v)->map(function (string $x) { return strrev($x); })->get();
        };

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
        $fn = function ($v) {
            return Objects::with($v)->map(function (Person $x) {
                $x->age *= 2;
                return $x;
            })->get();
        };

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([
                new Person("Chris", "Evans", 27),
                new Person("John", "Doe", 20),
            ])
            ->expect([
                new Person("Chris", "Evans", 54),
                new Person("John", "Doe", 40),
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}