<?php

namespace HasPhp\Functions;

use Exception;
use HasPhp\Types\IterList;

/**
 * Trait Foldr1
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Foldr1
{
    /**
     * Iteratively apply $fn from right -> left, returning the final result.
     * @param callable $fn
     * @return int|mixed|string|Null_
     * @throws Exception
     */
    public function foldr1(callable $fn)
    {
        if (count($this->arr) == 0) {
            throw new Exception("Empty list");
        }

        $end = count($this->arr) - 1;
        $out = $this->arr[$end];

        for ($i = $end - 1; $i >= 0; $i--) {
            $out = call_user_func($fn, $this->arr[$i], $out);
        }

        return $out;
    }
}