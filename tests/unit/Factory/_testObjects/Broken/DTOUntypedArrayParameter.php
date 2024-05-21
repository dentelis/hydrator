<?php

namespace tests\unit\Factory\_testObjects\Broken;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DTOUntypedArrayParameter
{

    use DTOFactoryTrait;

    public function __construct(public array $arr)
    {
    }

}
