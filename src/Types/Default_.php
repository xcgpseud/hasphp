<?php

namespace HasPhp\Types;

class Default_
{
    /**
     * @param ListType $listType
     * @return int|string|null
     */
    public static function from(ListType $listType)
    {
        switch ($listType) {
            case ListType::INTS():
                return 0;
            case ListType::STRINGS():
                return "";
            case ListType::OBJECTS():
                return null;
        }
    }
}