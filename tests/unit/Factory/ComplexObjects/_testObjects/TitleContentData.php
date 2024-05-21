<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class TitleContentData
{
    use HydratorFactoryTrait;

    function __construct(public string $text)
    {
    }
}