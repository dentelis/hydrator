<?php

namespace tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DriverDTO
{
    use DTOFactoryTrait;

    public string $name;

    public int $age;


}