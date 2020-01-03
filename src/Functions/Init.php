<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Init
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Init
{
    /**
     * Returns the IterList without its last element.
     * @return mixed
     */
    public function init()
    {
        if (count($this->arr) > 0) {
            return self::with(array_slice($this->arr, 0, -1));
        }

        return self::with([]);
    }
}