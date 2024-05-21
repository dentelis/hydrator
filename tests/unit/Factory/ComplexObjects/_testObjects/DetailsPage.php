<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Factory\DTOFactoryTrait;

class DetailsPage
{
    use DTOFactoryTrait;

    function __construct(public string $title, public TextContent|ImageContent|TitleContent $content)
    {
    }
}
