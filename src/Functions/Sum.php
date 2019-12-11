<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Sum
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Sum
{
    /**
     * @return int
     */
    public function sum(): int
    {
        $out = 0;
        foreach ($this->arr as $v) {
            $out += $v;
        }
        return $out;
    }
}