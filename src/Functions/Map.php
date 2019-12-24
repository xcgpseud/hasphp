<?php

namespace HasPhp\Functions;

use Exception;
use HasPhp\Types\IterList;

/**
 * Trait Map
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Map
{
    /**
     * Returns a new IterList with the provided closure applied to all of the elements of the initial IterList.
     * @param $fn
     * @return IterList
     * @throws Exception
     */
    public function map($fn): IterList
    {
        $out = [];
        foreach ($this->arr as $v) {
            $out[] = call_user_func($fn, $v);
        }
        return self::with($out);
    }
}