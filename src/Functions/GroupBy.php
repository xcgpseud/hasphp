<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;
use HasPhp\Types\ManyMap;

/**
 * Trait GroupBy
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait GroupBy
{
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
                $out[] = $this->dynamicWith($current);
                $current = [];
            }
        }

        return $this->dynamicManyWith($out);
    }
}