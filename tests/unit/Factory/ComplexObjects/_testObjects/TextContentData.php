<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;

class TextContentData
{
    use DTOFactoryTrait;

    function __construct(public string $text)
    {
    }
}