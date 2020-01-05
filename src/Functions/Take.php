<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Take
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Take
{
    /**
     * Take the first $num elements from the IterList as a new IterList.
     * @param int $num
     * @return IterList
     */
    public function take(int $num): IterList
    {
        $out = [];

        $count = count($this->arr);

        if ($count == 0) {
            return self::with($out);
        }

        if ($num >= $count) {
            return self::with($this->arr);
        }

        for ($i = 0; $i < $num; $i++) {
            $out[] = $this->arr[$i];
        }
        return self::with($out);
    }
}