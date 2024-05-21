<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Exception;
use Lbaf\Factory\DTOFactoryTrait;

class PolyContent
{
    use DTOFactoryTrait;

    public ImageContentData|TextContentData|TitleContentData|null $data;

    function __construct(public string $type, mixed $data)
    {
        $this->data = match ($type) {
            'image' => ImageContentData::getFactory()->createObject($data),
            'text'  => TextContentData::getFactory()->createObject($data),
            'title' => TitleContentData::getFactory()->createObject($data),
            'null'  => null,
            default => throw new \Exception('unsupported'),
        };
    }
}