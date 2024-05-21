<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class TitleContentData
{
    use DTOFactoryTrait;

    function __construct(public string $text)
    {
    }
}