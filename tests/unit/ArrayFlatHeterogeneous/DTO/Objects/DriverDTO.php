<?php

namespace tests\unit\ArrayFlatHeterogeneous\DTO\Objects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DriverDTO
{
    use HydratorFactoryTrait;

    public string $name;

    public int $age;


}