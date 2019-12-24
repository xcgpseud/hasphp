<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Any
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Any
{
    /**
     * Returns whether any of the elements in the IterList match the provided predicate.
     * @param callable $fn
     * @return bool
     */
    public function any(callable $fn): bool
    {
        foreach ($this->arr as $v) {
            if (call_user_func($fn, $v)) {
                return true;
            }
        }
        return false;
    }
}