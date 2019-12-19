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
     * @param callable $fn
     * @return bool
     */
    public function all(callable $fn): bool
    {
        if (empty($this->arr)) {
            return false;
        }

        foreach ($this->arr as $v) {
            if (!call_user_func($fn, $v)) {
                return false;
            }
        }
        return true;
    }
}