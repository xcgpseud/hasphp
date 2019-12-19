<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{All, Map};

class Objects extends IterList
{
    use All, Map;

    /**
     * @param array $arr
     * @return static
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
        return is_object($value) && gettype($value) == $this->firstType;
    }
}