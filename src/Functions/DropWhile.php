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
    /**
     * Return a new IterList with only values that hold while the predicate remains true, followed by the remaining
     * elements.
     * @param callable $fn
     * @return IterList
     */
    public function dropWhile(callable $fn): IterList
    {
        $out = [];
        $failed = false;

        foreach ($this->arr as $v) {
            if ($failed || call_user_func($fn, $v) === false) {
                $out[] = $v;
                $failed = true;
            }
        }

        return self::with($out);
    }
}