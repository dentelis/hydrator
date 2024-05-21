<?php

namespace tests\unit\ArrayFlatHeterogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

class DTOArrayHeterogeneousWithConstructor
{
    use HydratorFactoryTrait;

    /**
     * @param CarDTO[]|DriverDTO[] $objects
     */
    #[ArrayTypeOf('objects', [CarDTO::class, DriverDTO::class])]
    function __construct(public array $objects)
    {

    }

}