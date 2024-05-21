<?php

namespace tests\unit\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\Enums\UnbakedEnum;

class DTOWithUntypedEn
{
    use HydratorFactoryTrait;

    public UnbakedEnum $enum;

}
