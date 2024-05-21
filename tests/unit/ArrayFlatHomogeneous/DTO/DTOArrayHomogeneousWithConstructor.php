<?php

namespace tests\unit\ArrayFlatHomogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\DTOWithConstructor;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;

class DTOArrayHomogeneousWithConstructor
{
    use HydratorFactoryTrait;


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