<?php

namespace HasPhp\Functions;

use Exception;
use HasPhp\Types\IterList;

/**
 * Class Foldl1
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Foldl1
{
    /**
     *
     * Iteratively apply $fn from left -> right, returning the final result.
     * @param callable $fn
     * @return int|mixed|string|Null_
     * @throws Exception
     */
    public function foldl1(callable $fn)
    {
        if (count($this->arr) == 0) {
            throw new Exception("Empty list");
        }

        $out = $this->arr[0];

        for ($i = 1; $i < count($this->arr); $i++) {
            $out = call_user_func($fn, $out, $this->arr[$i]);
        }

        return $out;
    }
}