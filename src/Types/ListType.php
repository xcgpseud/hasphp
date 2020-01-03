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
 *
 * @method static ListType MANY_INTS()
 * @method static ListType MANY_STRINGS()
 * @method static ListType MANY_OBJECTS()
 */
class ListType extends Enum
{
    private const INTS = Ints::class;
    private const STRINGS = Strings::class;
    private const OBJECTS = Objects::class;

    private const MANY_INTS = ManyInts::class;
    private const MANY_STRINGS = ManyStrings::class;
    private const MANY_OBJECTS = ManyObjects::class;
}