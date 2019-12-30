<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait DropWhile
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait DropWhile
{
    public function dropWhile(callable $fn): IterList
    {
        $out = [];
        $failed = false;

        foreach ($this->arr as $v) {
            if ($failed || !call_user_func($fn, $v)) {
                $out[] = $v;
                $failed = true;
            }
        }

        return self::with($out);
    }
}