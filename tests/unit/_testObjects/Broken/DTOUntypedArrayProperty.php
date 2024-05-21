<?php

namespace tests\unit\_testObjects\Broken;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DTOUntypedArrayProperty
{
    use HydratorFactoryTrait;

    public array $arr;

}
