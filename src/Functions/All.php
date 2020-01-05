<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait All
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait All
{
    /**
     * Returns whether all elements in the IterList match the provided predicate.
     * @param callable $fn
     * @return bool
     */
    public function all(callable $fn): bool
    {
        if (empty($this->arr)) {
            return false;
        }

        foreach ($this->arr as $v) {
            if (call_user_func($fn, $v) === false) {
                return false;
            }
        }
        return true;
    }
}