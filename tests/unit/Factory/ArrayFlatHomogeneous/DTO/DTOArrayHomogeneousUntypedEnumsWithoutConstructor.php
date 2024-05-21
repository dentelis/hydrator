<?php

namespace tests\unit\Factory\ArrayFlatHomogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\UnbakedEnum;

class DTOArrayHomogeneousUntypedEnumsWithoutConstructor
{
    use HydratorFactoryTrait;

    #[ArrayTypeOf(UnbakedEnum::class)]
    public array $untypedEnums;


}