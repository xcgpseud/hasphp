<?php

namespace Tests\Functions;

use Exception;
use HasPhp\Types\Ints;
use Tests\MainTestCase;

class MapTest extends MainTestCase
{
    public function testIntsMap(): void
    {
        $fn = function ($v) { return $v * 2; };
        $fnRun = function ($in, $out, $fn) {
            if (!is_array($out)) {
                $this->expectException($out);
                Ints::with($in)->map($fn);
            } else {
                $this->assertEquals($out, Ints::with($in)->map($fn)->get());
            }
        };

        $fnRun([], [], $fn);
        $fnRun([1, 2, 3, 4, 5], [2, 4, 6, 8, 10], $fn);
        $fnRun(["should", "throw", "exception"], Exception::class, $fn);
        $fnRun([1, "mixed"], Exception::class, $fn);
    }
}