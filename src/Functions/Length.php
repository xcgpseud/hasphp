<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Length
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Length
{
    /**
     * Returns the length of the IterList.
     * @return int
     */
    public function length(): int
    {
        return count($this->arr);
    }
}