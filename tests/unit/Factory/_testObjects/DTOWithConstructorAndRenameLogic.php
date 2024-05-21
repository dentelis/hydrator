<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DTOWithConstructorAndRenameLogic
{
    use HydratorFactoryTrait;

    public ?string $realTitle = null;

    function __construct(string $title)
    {
        $this->realTitle = 'Mr. ' . $title;
    }

}