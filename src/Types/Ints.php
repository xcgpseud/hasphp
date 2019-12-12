<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{Abs, Map, Sum};

class Ints extends IterList
{
    use Map, Sum, Abs;

    /**
     * @param array $arr
     * @return $this
     * @throws Exception
     */
    public static function with(array $arr): self
    {
        $self = new self($arr);
        $self->throwIfInvalid();
        return $self;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function checkValidity($value): bool
    {
        return is_int($value) || is_float($value) || is_double($value);
    }
}