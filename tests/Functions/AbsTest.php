<?php


namespace Tests\Functions;


use HasPhp\Types\Ints;
use Tests\MainTestCase;
use Tests\TestBuilder;

class AbsTest extends MainTestCase
{
    public function testIntsAbs(): void
    {
        $fn = function ($in) {
            return Ints::with($in)->abs()->get();
        };

        TestBuilder::make()
            ->in([])
            ->expect([])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([1, 2, 3])
            ->expect([1, 2, 3])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([-2, -1, 0, 1, 2])
            ->expect([2, 1, 0, 1, 2])
            ->fn($fn)
            ->runTestEquals();

        TestBuilder::make()
            ->in([-1.1, 1.1, 2.123])
            ->expect([1.1, 1.1, 2.123])
            ->fn($fn)
            ->runTestEquals();
    }
}