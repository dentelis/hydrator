<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\UnbakedEnum;

class DTOWithUntypedEn
{
    use DTOFactoryTrait;

    public UnbakedEnum $enum;

}
