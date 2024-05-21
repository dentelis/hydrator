<?php

namespace tests\unit\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class TitleContentData
{
    use HydratorFactoryTrait;

    function __construct(public string $text)
    {
    }
}