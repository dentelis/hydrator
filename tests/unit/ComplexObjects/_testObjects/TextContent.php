<?php

namespace tests\unit\ComplexObjects\_testObjects;

use Exception;

class TextContent
{

    const TYPE = 'text';

    function __construct(public string $type, public TextContentData $data)
    {
        if ($this->type != self::TYPE) {
            throw new Exception('invalid type');
        }
    }
}