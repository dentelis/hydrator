<?php

namespace tests\unit\Factory\ArrayFlatHomogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\DTOWithConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOArrayHomogeneousWithoutConstructor
{
    use DTOFactoryTrait;

    #[ArrayTypeOf(StringEnum::class)]
    public array $stringEnums;

    #[ArrayTypeOf(IntEnum::class)]
    public array $intEnums;

    #[ArrayTypeOf('string')]
    public array $strings;

    #[ArrayTypeOf(DTOWithConstructor::class)]
    public array $objects;

}