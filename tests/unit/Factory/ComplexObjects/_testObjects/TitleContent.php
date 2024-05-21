<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Exception;

class TitleContent
{
    const TYPE = 'title';

    function __construct(public string $type, public TitleContentData $data)
    {
        if ($this->type != self::TYPE) {
            throw new Exception('invalid type');
        }
    }
}