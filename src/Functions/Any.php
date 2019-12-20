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