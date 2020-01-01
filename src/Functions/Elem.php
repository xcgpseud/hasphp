<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Elem
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Elem
{
    /**
     * Return true if the IterList contains the passed value; false otherwise.
     * @param $value
     * @return bool
     */
    public function elem($value): bool
    {
        foreach ($this->arr as $v) {
            if ($v === $value) {
                return true;
            }
        }
        return false;
    }
}