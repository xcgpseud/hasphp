<?php

namespace HasPhp\Types;

use MyCLabs\Enum\Enum;

/**
 * Class ListType
 * @package HasPhp\Types
 *
 * @method static ListType INTS()
 * @method static ListType STRINGS()
 * @method static ListType OBJECTS()
 */
class ListType extends Enum
{
    private const INTS = Ints::class;
    private const STRINGS = Strings::class;
    private const OBJECTS = Objects::class;
}