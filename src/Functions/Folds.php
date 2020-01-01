<?php

namespace HasPhp\Functions;

use Exception;
use HasPhp\Types\IterList;
use HasPhp\Types\ListType;

/**
 * Trait Folds
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Folds
{
    /**
     * Iteratively apply $fn from left -> right with $init as a starting point, returning the final result.
     * @param callable $fn
     * @param $init
     * @return mixed
     */
    public function foldl(callable $fn, $init)
    {
        if (count($this->arr) == 0) {
            return $init;
        }

        $out = call_user_func($fn, $init, $this->arr[0]);

        for ($i = 1; $i < count($this->arr); $i++) {
            $out = call_user_func($fn, $out, $this->arr[$i]);
        }

        return $out;
    }

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

    /**
     *
     * Iteratively apply $fn from left -> right, returning the final result.
     * @param callable $fn
     * @return int|mixed|string|null
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

    /**
     * Iteratively apply $fn from right -> left, returning the final result.
     * @param callable $fn
     * @return int|mixed|string|null
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