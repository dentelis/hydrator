<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class PolyContent
{
    use HydratorFactoryTrait;

    public ImageContentData|TextContentData|TitleContentData|null $data;

    function __construct(public string $type, mixed $data)
    {
        $this->data = match ($type) {
            'image' => ImageContentData::getHydratorFactory()->createObject($data),
            'text'  => TextContentData::getHydratorFactory()->createObject($data),
            'title' => TitleContentData::getHydratorFactory()->createObject($data),
            'null'  => null,
            default => throw new \Exception('unsupported'),
        };
    }
}