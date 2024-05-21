<?php

namespace tests\unit\ComplexObjects\_testObjects;

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