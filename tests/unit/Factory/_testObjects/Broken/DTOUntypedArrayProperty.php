<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DTOUntypedArrayProperty
{
    use DTOFactoryTrait;

    public array $arr;

}
