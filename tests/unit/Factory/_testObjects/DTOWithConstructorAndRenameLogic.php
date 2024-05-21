<?php

namespace tests\unit\Factory\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DTOWithConstructorAndRenameLogic
{
    use DTOFactoryTrait;

    public ?string $realTitle = null;

    function __construct(string $title)
    {
        $this->realTitle = 'Mr. ' . $title;
    }

}