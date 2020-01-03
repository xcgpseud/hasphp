<?php

namespace HasPhp\Types;

use Exception;

class ManyObjects extends IterList
{
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
        return get_class($value) == ListType::OBJECTS();
    }
}