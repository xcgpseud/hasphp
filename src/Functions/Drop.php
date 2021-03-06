<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Drop
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Drop
{
    /**
     * Return a new IterList with only values from the key of the provided integer and onwards.
     * @param int $from
     * @return IterList
     */
    public function drop(int $from): IterList
    {
        $out = [];
        for ($i = $from; $i < count($this->arr); $i++) {
            $out[] = $this->arr[$i];
        }
        return self::with($out);
    }
}