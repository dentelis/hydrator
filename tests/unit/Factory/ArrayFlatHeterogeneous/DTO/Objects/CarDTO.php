<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class CarDTO
{
    use HydratorFactoryTrait;

    function __construct(
        public string    $model,
        public int       $year,
        public DriverDTO $driver,
    )
    {

    }


}