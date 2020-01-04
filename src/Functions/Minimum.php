<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait Minimum
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Minimum
{
    /**
     * Returns the minimum value in the IterList.
     * @return int|string
     */
    public function minimum()
    {
        if (count($this->arr) == 0) {
            return Default_::from($this->getListType());
        }

        return min($this->arr);
    }
}