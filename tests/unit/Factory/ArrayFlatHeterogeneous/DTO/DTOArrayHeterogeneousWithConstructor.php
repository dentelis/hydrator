<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

class DTOArrayHeterogeneousWithConstructor
{
    use DTOFactoryTrait;

    /**
     * @param CarDTO[]|DriverDTO[] $objects
     */
    #[ArrayTypeOf('objects', [CarDTO::class, DriverDTO::class])]
    function __construct(public array $objects)
    {

    }

}