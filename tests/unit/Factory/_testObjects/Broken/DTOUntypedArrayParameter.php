<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DTOUntypedArrayParameter
{

    use HydratorFactoryTrait;

    public function __construct(public array $arr)
    {
    }

}
