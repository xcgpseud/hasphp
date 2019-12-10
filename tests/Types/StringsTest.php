<?php

namespace Tests\Types;

use Exception;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;

class StringsTest extends MainTestCase
{
    public function testStringsDoesAcceptStrings(): void
    {
        $strings = Strings::with(["one", "two", "three"]);
        $this->assertEquals(["one", "two", "three"], $strings->get());
    }

    public function testStringsDoesNotAcceptIntegers(): void
    {
        $this->expectException(Exception::class);
        Strings::with([1, 2, 3]);
    }

    public function testStringsDoesNotAcceptObjects(): void
    {
        $this->expectException(Exception::class);
        Strings::with([
            new Person("Chris", "Evans", 27),
        ]);
    }

    public function testStringsDoesNotAcceptMixedIncludingStrings(): void
    {
        $this->expectException(Exception::class);
        Strings::with(["valid", "also valid", 2]);
    }
}