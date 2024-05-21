<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DTOWithConstructorAndLogic
{
    use DTOFactoryTrait;

    public string $title;

    function __construct(string $title)
    {
        $this->title = 'Mr. ' . $title;
    }

}