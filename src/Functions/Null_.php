<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Null
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Null_
{
    /**
     * Returns true if the list is empty; else false.
     * @return bool
     */
    public function null_(): bool
    {
        return empty($this->arr);
    }
}