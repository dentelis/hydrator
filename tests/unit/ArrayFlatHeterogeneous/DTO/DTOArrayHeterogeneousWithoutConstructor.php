<?php

namespace tests\unit\ArrayFlatHeterogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

class DTOArrayHeterogeneousWithoutConstructor
{
    use HydratorFactoryTrait;


    #[ArrayTypeOf([CarDTO::class, DriverDTO::class])]
    public array $objects;

}