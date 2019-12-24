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
    /**
     * Delete the first item in the initial IterList that matches the provided value.
     * @param $value
     * @return IterList
     */
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