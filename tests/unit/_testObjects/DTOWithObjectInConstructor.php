<?php

namespace tests\unit\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\Enums\StringEnum;

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