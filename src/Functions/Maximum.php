<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait Maximum
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Maximum
{
    /**
     * Returns the maximum value in the IterList.
     * @return int|string
     */
    public function maximum()
    {
        if (count($this->arr) == 0) {
            return Default_::from($this->getListType());
        }

        return max($this->arr);
    }
}