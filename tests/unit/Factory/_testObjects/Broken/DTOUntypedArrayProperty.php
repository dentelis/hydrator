<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Lbaf\Factory\DTOFactoryTrait;

class DTOUntypedArrayProperty
{
    use DTOFactoryTrait;

    public array $arr;

}
