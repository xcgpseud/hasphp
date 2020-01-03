<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;
use HasPhp\Types\ManyMap;

/**
 * Trait Groups
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Groups
{
    /**
     * Returns a Many List of the original type with equal, adjacent elements.
     * @return IterList
     */
    public function group(): IterList
    {
        $current = [];
        $out = [];

        foreach ($this->arr as $i => $v) {
            $current[] = $v;
            if ($i == count($this->arr) - 1 || $v != $this->arr[$i + 1]) {
                $out[] = call_user_func($this->getListType() . '::with', $current);
                $current = [];
            }
        }

        return call_user_func(ManyMap::toMany($this->getListType()) . '::with', $out);
    }

    /**
     * Returns a Many List of the original type with equal, adjacent elements, with a custom equality predicate.
     * @param callable $fn
     * @return IterList
     */
    public function groupBy(callable $fn): IterList
    {
        $current = [];
        $out = [];

        foreach ($this->arr as $i => $v) {
            $current[] = $v;

            if (
                $i == count($this->arr) - 1 ||
                call_user_func($fn, $current[0], $this->arr[$i + 1]) === false
            ) {
                $out[] = call_user_func($this->getListType() . '::with', $current);
                $current = [];
            }
        }

        return call_user_func(ManyMap::toMany($this->getListType()) . '::with', $out);
    }
}