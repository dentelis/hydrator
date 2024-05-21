<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class DetailsPage
{
    use HydratorFactoryTrait;

    function __construct(public string $title, public TextContent|ImageContent|TitleContent $content)
    {
    }
}
