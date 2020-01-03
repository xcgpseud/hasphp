<?php

namespace HasPhp\Types;

class ManyMap
{
    /**
     * @param ListType $listType
     * @return ListType
     */
    public static function toMany(ListType $listType): ListType
    {
        switch ($listType->getValue()) {
            case ListType::INTS():
                return ListType::MANY_INTS();
            case ListType::STRINGS():
                return ListType::MANY_STRINGS();
            case ListType::OBJECTS():
                return ListType::MANY_OBJECTS();
        }
        return null;
    }

    /**
     * @param ListType $listType
     * @return ListType
     */
    public static function toOne(ListType $listType): ListType
    {
        switch ($listType->getValue()) {
            case ListType::MANY_INTS():
                return ListType::INTS();
            case ListType::MANY_STRINGS():
                return ListType::STRINGS();
            case ListType::MANY_OBJECTS():
                return ListType::OBJECTS();
        }
        return null;
    }
}