<?php

namespace HasPhp\Types;

use Exception;

abstract class IterList
{
    /** @var array */
    protected array $arr;

    /** @var string */
    protected string $firstType;

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
     * @return ListType
     */
    public function getListType(): ListType
    {
        return new ListType(get_called_class());
    }

    /**
     * @param array $arr
     * @return IterList
     */
    public function manyWith(array $arr): IterList
    {
        return call_user_func(ManyMap::toMany($this->getListType()) . '::with', $arr);
    }

    /**
     * @throws Exception
     */
    protected function throwIfInvalid()
    {
        $first = reset($this->arr);
        if (is_object($first)) {
            $this->firstType = get_class($first);
        }

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