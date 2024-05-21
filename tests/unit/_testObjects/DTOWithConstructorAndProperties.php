<?php

namespace tests\unit\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;

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