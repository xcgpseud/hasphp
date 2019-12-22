<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Delete
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Delete
{
    public function delete($value): IterList
    {
        $deleted = false;
        $out = [];

        foreach ($this->arr as $v) {
            if ($deleted || $v != $value) {
                $out[] = $v;
            } else {
                $deleted = true;
            }
        }

        return self::with($out);
    }
}