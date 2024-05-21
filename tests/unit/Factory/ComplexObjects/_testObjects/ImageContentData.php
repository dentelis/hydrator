<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class ImageContentData
{
    use HydratorFactoryTrait;

    function __construct(
        public string $url,
        public int    $size,
    )
    {

    }
}