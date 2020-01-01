<?php

namespace Tests\Functions;

use HasPhp\Types\Ints;
use HasPhp\Types\ListType;
use HasPhp\Types\Objects;
use HasPhp\Types\Strings;
use Tests\MainTestCase;
use Tests\Person;
use Tests\TestBuilder;

class ListTypeTest extends MainTestCase
{
    public function testGetType(): void
    {
        $ints = Ints::with([1])->getListType();
        $strings = Strings::with(["hi"])->getListType();
        $objects = Objects::with([new Person("Chris", "Evans", 27)])->getListType();

        $this->assertEquals(ListType::INTS, $ints);
        $this->assertEquals(ListType::STRINGS, $strings);
        $this->assertEquals(ListType::OBJECTS, $objects);
    }
}