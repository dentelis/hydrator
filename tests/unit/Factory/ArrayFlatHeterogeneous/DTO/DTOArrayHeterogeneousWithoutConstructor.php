<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

class DTOArrayHeterogeneousWithoutConstructor
{
    use DTOFactoryTrait;


    #[ArrayTypeOf([CarDTO::class, DriverDTO::class])]
    public array $objects;

}