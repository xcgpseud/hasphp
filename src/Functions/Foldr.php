<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Foldr
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Foldr
{
    /**
     * Iteratively apply $fn from right -> left with $init as a starting point, returning the final result.
     * @param callable $fn
     * @param $init
     * @return mixed
     */
    public function foldr(callable $fn, $init)
    {
        if (count($this->arr) == 0) {
            return $init;
        }

        $end = count($this->arr) - 1;
        $out = call_user_func($fn, $this->arr[$end], $init);

        for ($i = $end - 1; $i >= 0; $i--) {
            $out = call_user_func($fn, $this->arr[$i], $out);
        }

        return $out;
    }
}