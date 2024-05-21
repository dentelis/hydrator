<?php

namespace tests\unit\ComplexObjects\_testObjects;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;

class StoryPage
{
    use HydratorFactoryTrait;

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
