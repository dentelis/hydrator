<?php

namespace tests\unit\Factory\ComplexObjects\_testObjects;

use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Factory\DTOFactoryTrait;

class StoryPage
{
    use DTOFactoryTrait;

    // указание тут ArrayTypeOf - ключевой момент для сборки
    #[
        ArrayTypeOf(
            'content',
            [
                TextContent::class,
                ImageContent::class,
                TitleContent::class,
            ]
        ),
    ]
    /**
     * @var TextContent[]|ImageContent[]|TitleContent[] $content
     */
    function __construct(public string $title, public array $content)
    {
    }
}
