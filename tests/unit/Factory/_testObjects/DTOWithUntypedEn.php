<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\UnbakedEnum;

class DTOWithUntypedEn
{
    use HydratorFactoryTrait;

    public UnbakedEnum $enum;

}
