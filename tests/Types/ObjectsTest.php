<?php

namespace Tests\Types;

use Exception;
use HasPhp\Types\Objects;
use Tests\Dog;
use Tests\MainTestCase;
use Tests\Person;

class ObjectsTest extends MainTestCase
{
    public function testObjectsDoesAcceptObjects(): void
    {
        $objs = Objects::with($this->getFakePeople(2));
        $this->assertEquals(2, count($objs->get()));
    }

    public function testObjectsDoesNotAcceptInts(): void
    {
        $this->expectException(Exception::class);
        Objects::with([1, 2, 3]);
    }

    public function testObjectsDoesNotAcceptStrings(): void
    {
        $this->expectException(Exception::class);
        Objects::with(["these", "are", "strings"]);
    }

    public function testObjectsDoesNotAcceptMixedIncludingObjects(): void
    {
        $this->expectException(Exception::class);
        Objects::with([
            $this->getFakePerson(),
            1,
            2,
        ]);
    }

    public function testObjectsDoesNotAcceptMixedObjectTypes(): void
    {
        $this->expectException(Exception::class);
        Objects::with([
            $this->getFakePerson(),
            new Dog("Saska", "White"),
        ]);
    }
}