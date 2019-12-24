<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Average
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Average
{
    /**
     * Returns the average value of all items in the IterList.
     * @return float
     */
    public function average(): float
    {
        if (empty($this->arr)) {
            return (float)0;
        }
        $sum = 0;
        foreach ($this->arr as $v) {
            $sum += $v;
        }
        return (float)($sum / count($this->arr));
    }
}