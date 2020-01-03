<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;
use HasPhp\Types\ManyMap;

/**
 * Class Group
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Group
{
    /**
     * Returns a Many List of the original type with equal, adjacent elements.
     * @return IterList
     */
    public function group(): IterList
    {
        $current = [];
        $out = [];

        foreach ($this->arr as $i => $v) {
            $current[] = $v;
            if ($i == count($this->arr) - 1 || $v != $this->arr[$i + 1]) {
                $out[] = $this->dynamicWith($current);
                $current = [];
            }
        }

        return $this->dynamicManyWith($out);
    }
}
