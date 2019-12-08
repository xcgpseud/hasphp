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
     * @param $fn
     * @return Map
     * @throws Exception
     */
    public function map($fn)
    {
        $out = [];
        foreach ($this->arr as $v) {
            $out[] = call_user_func($fn, $v);
        }
        return self::with($out);
    }
}