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
     * Returns two IterLists as a tuple, where the first one contains all elements in the initial IterList
     * up until the predicate returns true, and the second one contains everything after that.
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

        return [self::with($before), self::with($after)];
    }
}