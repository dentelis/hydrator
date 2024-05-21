<?php

namespace tests\unit\Factory\ArrayFlatHomogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\DTOWithConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOArrayHomogeneousWithConstructor
{
    use DTOFactoryTrait;


    #[
        ArrayTypeOf('stringEnums', StringEnum::class),
        ArrayTypeOf('intEnums', IntEnum::class),
        ArrayTypeOf('strings', 'string'),
        ArrayTypeOf('objects', DTOWithConstructor::class),
    ]
    public function __construct(
        public array $stringEnums,
        public array $intEnums,
        public array $strings,
        public array $objects,
    )
    {

    }

}