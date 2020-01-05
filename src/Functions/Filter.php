<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Filter
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Filter
{
    /**
     * Returns a new IterList with all of the elements that match the predicate.
     * @param callable $fn
     * @return IterList
     */
    public function filter(callable $fn): IterList
    {
        $out = [];
        foreach ($this->arr as $v) {
            if (call_user_func($fn, $v) === true) {
                $out[] = $v;
            }
        }
        return self::with($out);
    }
}