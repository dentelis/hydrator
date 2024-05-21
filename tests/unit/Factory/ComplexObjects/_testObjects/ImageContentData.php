<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;

class ImageContentData
{
    use DTOFactoryTrait;

    function __construct(
        public string $url,
        public int    $size,
    )
    {

    }
}