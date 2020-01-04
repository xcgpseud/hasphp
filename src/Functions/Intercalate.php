<?php

namespace HasPhp\Functions;

use HasPhp\Types\IterList;

/**
 * Trait Intercalate
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Intercalate
{
    /**
     * Returns a Many List with the method receiver inserted into each step.
     * @param array $many
     * @return IterList
     */
    public function intercalate(array $many): IterList
    {
        $out = [];

        foreach ($many as $i => $list) {
            foreach ($list as $v) {
                $out[] = $v;
            }
            if ($i == count($many) - 1) {
                break;
            }
            foreach ($this->arr as $v) {
                $out[] = $v;
            }
        }

        return self::with($out);
    }
}