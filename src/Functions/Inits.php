<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Inits
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Inits
{
    /**
     * Returns a Many List of initial segments of the IterList, shortest first.
     * @return IterList
     */
    public function inits(): IterList
    {
        $temp = [];
        $out = [self::with($temp)];

        foreach ($this->arr as $v) {
            $temp[] = $v;
            $out[] = self::with($temp);
        }

        return $this->manyWith($out);
    }
}