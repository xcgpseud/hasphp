<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Break_
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Break_
{
    /**
     * @param callable $fn
     * @return IterList[]
     */
    public function break_(callable $fn): array
    {
        $before = [];
        $after = [];
        $passed = false;

        foreach ($this->arr as $v) {
            if ($passed || call_user_func($fn, $v)) {
                $after[] = $v;
                $passed = true;
            } else {
                $before[] = $v;
            }
        }

        return [$before, $after];
    }
}