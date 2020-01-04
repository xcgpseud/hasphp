<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Intersperse
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Intersperse
{
    public function intersperse($value): IterList
    {
        $out = [];

        foreach ($this->arr as $i => $v) {
            $out[] = $v;
            if ($i == count($this->arr) - 1) {
                break;
            }
            $out[] = $value;
        }

        return self::with($out);
    }
}