<?php

namespace HasPhp\Types;

use Exception;
use HasPhp\Functions\{All,
    Any,
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
    MaximumBy,
    MinimumBy,
    Nub,
    Null_,
    Tail,
    Take,
    TakeWhile};

class Objects extends IterList
{
    use   All
        , Any
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
        , MaximumBy
        , MinimumBy
        , Nub
        , Null_
        , Tail
        , Take
        , TakeWhile;

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
        return is_object($value) && get_class($value) == $this->firstType;
    }
}