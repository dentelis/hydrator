<?php

namespace tests\unit\Factory\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithObjectInConstructor
{
    use DTOFactoryTrait;

    function __construct(
        public string             $title,
        public StringEnum         $stringEnum,
        public DTOWithConstructor $object,
    )
    {

    }


}