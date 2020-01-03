<?php

namespace HasPhp\Types;

use Exception;

class Many extends IterList
{
    /**
     * Many constructor.
     * @param array $arr
     */
    public function __construct(array $arr)
    {
        parent::__construct($arr);
    }

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
        return in_array($this->firstType, [
                ListType::INTS(),
                ListType::STRINGS(),
                ListType::OBJECTS(),
            ]) && get_class($value) == $this->firstType;
    }
}