<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;

class DTOWithoutConstructor
{
    use DTOFactoryTrait;

    public string $title;
    public int $age;
    public bool $isActive;

    public IntEnum $intEnum;

    public StringEnum $stringEnum;

}