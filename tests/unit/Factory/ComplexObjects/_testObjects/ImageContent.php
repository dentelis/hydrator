<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Exception;

class ImageContent
{

    const TYPE = 'image';

    function __construct(public string $type, public ImageContentData $data)
    {
        if ($this->type != self::TYPE) {
            throw new Exception('invalid type');
        }
    }
}