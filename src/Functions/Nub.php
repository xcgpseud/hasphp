<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;

/**
 * Trait Nub
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Nub
{
    /**
     * Returns the IterList with duplicate elements removed.
     * @return IterList
     */
    public function nub(): IterList
    {
        if (count($this->arr) == 0) {
            return self::with([]);
        }

        $contains = [];
        $out = [];

        foreach ($this->arr as $v) {
            $ok = in_array($v, $contains);
            if (!$ok) {
                $contains[] = $v;
                $out[] = $v;
            }
        }

        return self::with($out);
    }
}