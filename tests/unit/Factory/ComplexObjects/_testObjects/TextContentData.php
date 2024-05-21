<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class TextContentData
{
    use DTOFactoryTrait;

    function __construct(public string $text)
    {
    }
}