<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{Map};

class Ints extends IterList
{
    use Map;

    /**
     * @param $arr
     * @return $this
     * @throws Exception
     */
    public function with($arr): self
    {
        $arr = is_array($arr) ? $arr : [$arr];
        self::throwIfInvalid($arr);
        return new self($arr);
    }

    /**
     * @param array $arr
     * @return bool
     * @throws Exception
     */
    protected static function throwIfInvalid(array $arr)
    {
        foreach ($arr as $v) {
            if (!is_int($v)) {
                throw new Exception(sprintf("Invalid type used in %s.", self::class));
            }
        }
    }
}