<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class Break_Test extends MainTestCase
{
    public function testIntsBreak_(): void
    {
        $fn = fn(array $in): array => Ints::with($in)->break_(fn(int $i): bool => $i % 2 == 0);

        TestBuilder::make()
            ->in([])
            ->expect([
                Ints::with([]),
                Ints::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 3, 5, 6, 7, 8])
            ->expect([
                Ints::with([1, 3, 5]),
                Ints::with([6, 7, 8]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testStringsBreak_(): void
    {
        $fn = fn(array $in): array => Strings::with($in)->break_(fn(string $s): bool => $s === strtoupper($s));

        TestBuilder::make()
            ->in([])
            ->expect([
                Strings::with([]),
                Strings::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in(["lower", "also lower", "Half Upper", "ALL UPPER", "lower again"])
            ->expect([
                Strings::with(["lower", "also lower", "Half Upper"]),
                Strings::with(["ALL UPPER", "lower again"]),
            ])
            ->fn($fn)
            ->runTestEquals();
    }

    public function testObjectsBreak_(): void
    {
        $fn = fn(array $in): array => Objects::with($in)->break_(fn(Person $x): bool => $x->age == 20);

        [$one, $two, $three] = $this->getFakePeopleWithAges([27, 20, 99]);

        TestBuilder::make()
            ->in([])
            ->expect([
                Objects::with([]),
                Objects::with([]),
            ])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([$one, $two, $three])
            ->expect([
                Objects::with([$one]),
                Objects::with([$two, $three])
            ])
            ->fn($fn)
            ->runTestEquals();
    }
}