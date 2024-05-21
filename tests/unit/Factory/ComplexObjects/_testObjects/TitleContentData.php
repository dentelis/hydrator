<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;

class TitleContentData
{
    use DTOFactoryTrait;

    function __construct(public string $text)
    {
    }
}