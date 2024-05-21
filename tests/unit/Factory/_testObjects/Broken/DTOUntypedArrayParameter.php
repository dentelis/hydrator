<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Lbaf\Factory\DTOFactoryTrait;

class DTOUntypedArrayParameter
{

    use DTOFactoryTrait;

    public function __construct(public array $arr)
    {
    }

}
