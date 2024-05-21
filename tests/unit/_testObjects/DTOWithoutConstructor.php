<?php

namespace tests\unit\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;

class DTOWithoutConstructor
{
    use HydratorFactoryTrait;

    public string $title;
    public int $age;
    public bool $isActive;

    public IntEnum $intEnum;

    public StringEnum $stringEnum;

}