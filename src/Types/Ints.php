<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{Abs,
    All,
    Any,
    Average,
    Break_,
    Delete,
    Drop,
    DropWhile,
    Elem,
    Filter,
    Foldl,
    Foldl1,
    Foldr,
    Foldr1,
    Group,
    GroupBy,
    Head,
    Init,
    Inits,
    Intercalate,
    Intersperse,
    Last,
    Length,
    Map,
    Maximum,
    MaximumBy,
    Minimum,
    MinimumBy,
    Nub,
    Null_,
    Sum,
    Tail
};

class Ints extends IterList
{
    use   Abs
        , All
        , Any
        , Average
        , Break_
        , Delete
        , Drop
        , DropWhile
        , Elem
        , Filter
        , Foldl
        , Foldr
        , Foldl1
        , Foldr1
        , Group
        , GroupBy
        , Head
        , Init
        , Inits
        , Intercalate
        , Intersperse
        , Last
        , Length
        , Map
        , Maximum
        , Minimum
        , MaximumBy
        , MinimumBy
        , Nub
        , Null_
        , Sum
        , Tail;

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