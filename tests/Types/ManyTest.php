<?php

namespace Tests\Types;

use Exception;
use HasPhp\Types\Ints;
use HasPhp\Types\Many;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\Dog;
use Tests\MainTestCase;
use Tests\Person;

class ManyTest extends MainTestCase
{
    public function testManyIntsDoesAcceptInts(): void
    {
        $manyInts = Many::with([
            Ints::with([1, 2]),
            Ints::with([3, 4]),
        ]);

        $this->assertIsArray($arr = $manyInts->get());

        $this->assertEquals([1, 2], $arr[0]->get());
        $this->assertEquals([3, 4], $arr[1]->get());
    }

    public function testManyStringsDoesAcceptStrings(): void
    {
        $manyStrings = Many::with([
            Strings::with(["hello"]),
            Strings::with(["world"]),
        ]);

        $this->assertIsArray($arr = $manyStrings->get());

        $this->assertEquals(["hello"], $arr[0]->get());
        $this->assertEquals(["world"], $arr[1]->get());
    }

    public function testManyObjectsDoesAcceptObjects(): void
    {
        $manyObjects = Many::with([
            Objects::with([new Person("Chris", "Evans", 27)]),
            Objects::with([new Person("John", "Doe", 30)]),
        ]);

        $this->assertIsArray($arr = $manyObjects->get());

        $this->assertEquals([new Person("Chris", "Evans", 27)], $arr[0]->get());
        $this->assertEquals([new Person("John", "Doe", 30)], $arr[1]->get());
    }

    public function testManyIntsDoesNotAllowMixed(): void
    {
        $this->expectException(Exception::class);
        $manyInts = Many::with([
            Ints::with([1, 2, 3]),
            Strings::with(["Hello", "World"]),
        ]);
    }

    public function testManyStringsDoesNotAllowMixed(): void
    {
        $this->expectException(Exception::class);
        $manyStrings = Many::with([
            Strings::with(["Hello", "World"]),
            Ints::with([1, 2, 3]),
        ]);
    }

    public function testManyObjectsDoesNotAllowMixed(): void
    {
        $this->expectException(Exception::class);
        $manyObjects = Many::with([
            Objects::with([new Person("Chris", "Evans", 27)]),
            Ints::with([1, 2, 3]),
        ]);
    }
}