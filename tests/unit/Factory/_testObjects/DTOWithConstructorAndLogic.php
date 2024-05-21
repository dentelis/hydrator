<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DTOWithConstructorAndLogic
{
    use HydratorFactoryTrait;

    public string $title;

    function __construct(string $title)
    {
        $this->title = 'Mr. ' . $title;
    }

}