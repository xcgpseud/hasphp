<?php

namespace HasPhp\Functions;

use HasPhp\Types\Default_;
use HasPhp\Types\IterList;
use HasPhp\Types\ListType;

/**
 * Trait Head
 * @package HasPhp\Functions
 * @mixin IterList
 */
trait Head
{
    /**
     * Returns the first element in the IterList.
     * @return mixed
     */
    public function head()
    {
        if (count($this->arr) > 0) {
            return $this->arr[0];
        }
        return Default_::from($this->getListType());
    }
}