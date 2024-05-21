<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects;

use Lbaf\Factory\DTOFactoryTrait;

class CarDTO
{
    use DTOFactoryTrait;

    function __construct(
        public string    $model,
        public int       $year,
        public DriverDTO $driver,
    )
    {

    }


}