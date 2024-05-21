<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Factory\DTOFactoryTrait;

class DetailsPage
{
    use DTOFactoryTrait;

    function __construct(public string $title, public TextContent|ImageContent|TitleContent $content)
    {
    }
}
