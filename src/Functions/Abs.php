<?php

namespace HasPhp\Functions;

use Exception;
use HasPhp\Types\IterList;

/**
 * Trait Abs
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Abs
{
    /**
     * Returns a new IterList with absolute values of all elements in the initial IterList.
     * @return IterList
     * @throws Exception
     */
    public function abs(): IterList
    {
        $out = [];
        foreach ($this->arr as $v) {
            $out[] = abs($v);
        }
        return self::with($out);
    }
}