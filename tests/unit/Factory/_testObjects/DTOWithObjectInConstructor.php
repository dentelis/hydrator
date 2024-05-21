<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithObjectInConstructor
{
    use HydratorFactoryTrait;

    function __construct(
        public string             $title,
        public StringEnum         $stringEnum,
        public DTOWithConstructor $object,
    )
    {

    }


}