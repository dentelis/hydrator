<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithConstructorAndProperties
{
    use HydratorFactoryTrait;

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