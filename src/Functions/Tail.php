<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait Tail
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Tail
{
    /**
     * Returns the IterList without its first element.
     * @return mixed
     */
    public function tail()
    {
        if (count($this->arr) > 0) {
            return self::with(array_slice($this->arr, 1));
        }
        return self::with([]);
    }
}