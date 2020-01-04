<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait MaximumBy
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait MaximumBy
{
    /**
     * Returns the maximum element in the IterList, according to the supplied predicate.
     * @param callable $fn
     * @return mixed
     */
    public function maximumBy(callable $fn)
    {
        if (count($this->arr) == 0) {
            return Default_::from($this->getListType());
        }

        $out = $this->arr[0];

        foreach ($this->arr as $v) {
            $out = $fn($out, $v);
        }

        return $out;
    }
}