<?php

namespace tests\unit\Factory\ArrayFlatHomogeneous\DTO;

use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\UntypedEnum;

class DTOArrayHomogeneousUntypedEnumsWithoutConstructor
{
    use DTOFactoryTrait;

    #[ArrayTypeOf(UntypedEnum::class)]
    public array $untypedEnums;


}