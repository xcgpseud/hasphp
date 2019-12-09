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
    public static function with($arr): self
    {
        $self = new self(is_array($arr) ? $arr : [$arr]);
        $self->throwIfInvalid();
        return $self;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function checkValidity($value): bool
    {
        return is_int($value);
    }
}