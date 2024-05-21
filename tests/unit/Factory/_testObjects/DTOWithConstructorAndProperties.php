<?php

namespace tests\unit\Factory\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithConstructorAndProperties
{
    use DTOFactoryTrait;

    public bool $isActive;
    public StringEnum $stringEnum;

    function __construct(
        public string  $title,
        public int     $age,
        public IntEnum $intEnum,

    )
    {

    }


}