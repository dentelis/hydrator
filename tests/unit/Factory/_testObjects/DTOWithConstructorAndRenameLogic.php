<?php

namespace tests\unit\Factory\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;

class DTOWithConstructorAndRenameLogic
{
    use DTOFactoryTrait;

    public ?string $realTitle = null;

    function __construct(string $title)
    {
        $this->realTitle = 'Mr. ' . $title;
    }

}