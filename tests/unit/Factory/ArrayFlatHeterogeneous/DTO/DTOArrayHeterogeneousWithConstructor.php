<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO;

use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Factory\DTOFactoryTrait;
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