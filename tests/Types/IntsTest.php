<?php

namespace Tests\Types;

use Exception;
use HasPhp\Types\Ints;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class IntsTest extends MainTestCase
{
    public function testIntsDoesAcceptIntegers(): void
    {
        $ints = Ints::with([1, 2, 3]);
        $this->assertEquals([1, 2, 3], $ints->get());
    }

    public function testIntsDoesNotAcceptStrings(): void
    {
        $this->expectException(Exception::class);
        Ints::with(["these", "are", "strings"]);
    }

    public function testIntsDoesNotAcceptObjects(): void
    {
        $this->expectException(Exception::class);
        Ints::with([
            new Person("Chris", "Evans", 27),
        ]);
    }

    public function testIntsDoesNotAcceptMixedIncludingIntegers(): void
    {
        $this->expectException(Exception::class);
        Ints::with([1, 2, "string"]);
    }

    public function testIntsDoesNotExceptNumericalsAsStrings(): void
    {
        $this->expectException(Exception::class);
        Ints::with(["1", "2", "3"]);
    }
}