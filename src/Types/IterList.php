<?php

namespace HasPhp\Types;

use Exception;

abstract class IterList
{
    /** @var array */
    protected $arr;

    /**
     * IterList constructor.
     * @param array $arr
     */
    public function __construct(array $arr)
    {
        $this->arr = $arr;
    }

    public function get(): array
    {
        return $this->arr;
    }

    abstract protected static function throwIfInvalid(array $arr);
}