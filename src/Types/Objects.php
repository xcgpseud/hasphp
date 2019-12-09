<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{Map};

class Objects extends IterList
{
    use Map;

    /**
     * @param $arr
     * @return static
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
        return is_object($value) && gettype($value) == $this->firstType;
    }
}