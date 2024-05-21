<?php

namespace tests\unit\Factory\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithConstructor
{
    use DTOFactoryTrait;

    function __construct(
        public string     $title,
        public int        $age,
        public bool       $isActive,
        public IntEnum    $intEnum,
        public StringEnum $stringEnum,
    )
    {

    }


}