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

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->arr;
    }

    /**
     * @throws Exception
     */
    protected function throwIfInvalid()
    {
        foreach ($this->arr as $v) {
            if (!$this->checkValidity($v)) {
                throw new Exception(sprintf("Invalid type used in %s.", self::class));
            }
        }
    }

    /**
     * @param $value
     * @return bool
     */
    abstract protected function checkValidity($value): bool;
}