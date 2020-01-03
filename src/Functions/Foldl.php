<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Class Foldl
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Foldl
{
    /**
     * Iteratively apply $fn from left -> right with $init as a starting point, returning the final result.
     * @param callable $fn
     * @param $init
     * @return mixed
     */
    public
    function foldl(
        callable $fn,
        $init
    ) {
        if (count($this->arr) == 0) {
            return $init;
        }

        $out = call_user_func($fn, $init, $this->arr[0]);

        for ($i = 1; $i < count($this->arr); $i++) {
            $out = call_user_func($fn, $out, $this->arr[$i]);
        }

        return $out;
    }
}