<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait TakeWhile
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait TakeWhile
{
    /**
     * Returns an IterList with all elements until the predicate fails.
     * @param callable $fn
     * @return IterList
     */
    public function takeWhile(callable $fn): IterList
    {
        $out = [];

        if (count($this->arr) == 0) {
            return self::with($out);
        }

        foreach ($this->arr as $v) {
            if ($fn($v) === false) {
                return self::with($out);
            }
            $out[] = $v;
        }

        return self::with($out);
    }
}