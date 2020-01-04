<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait Last
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Last
{
    /**
     * Returns the last element of the IterList.
     * @return int|string|object|null
     */
    public function last()
    {
        $count = count($this->arr);

        if ($count > 0) {
            return $this->arr[$count - 1];
        }

        return Default_::from($this->getListType());
    }
}