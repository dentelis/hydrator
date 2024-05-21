<?php
declare(strict_types=1);

namespace tests\unit\Factory\ComplexObjects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_traits\CheckObjectTrait;
use tests\unit\Factory\ComplexObjects\_testObjects\ImageContent;
use tests\unit\Factory\ComplexObjects\_testObjects\ImageContentData;
use tests\unit\Factory\ComplexObjects\_testObjects\StoryPage;
use tests\unit\Factory\ComplexObjects\_testObjects\TextContent;
use tests\unit\Factory\ComplexObjects\_testObjects\TextContentData;
use tests\unit\Factory\ComplexObjects\_testObjects\TitleContent;
use tests\unit\Factory\ComplexObjects\_testObjects\TitleContentData;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class ObjectPropertyIsHeterogeneousArrayTest extends TestCase
{
    use CheckObjectTrait;

    /**
     * Проверяем кейс когда тип одного параметра зависит от другого
     */
    public function testComplexPolymorph(): void
    {
        $instance = new StoryPage('first page', [
            new TitleContent(TitleContent::TYPE, new TitleContentData('The best header in the world')),
            new ImageContent(ImageContent::TYPE, new ImageContentData('https://mydomain.com/image.png', 111_000)),
            new TextContent(TextContent::TYPE, new TextContentData('loremipsum page 1')),
            new TextContent(TextContent::TYPE, new TextContentData('loremipsum page 2')),
        ]);

        $this->checkObject($instance);
    }

    //@todo кейс когда полиморфный объект лежит не в массиве, а в свойстве

}
