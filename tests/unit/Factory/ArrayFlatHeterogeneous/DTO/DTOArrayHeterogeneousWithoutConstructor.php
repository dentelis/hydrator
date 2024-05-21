<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO;

use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

class DTOArrayHeterogeneousWithoutConstructor
{
    use DTOFactoryTrait;


    #[ArrayTypeOf([CarDTO::class, DriverDTO::class])]
    public array $objects;

}