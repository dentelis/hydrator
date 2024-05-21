<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DTOUntypedArrayProperty
{
    use HydratorFactoryTrait;

    public array $arr;

}
