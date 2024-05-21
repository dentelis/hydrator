<?php
declare(strict_types=1);

namespace tests\unit\ComplexObjects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\_traits\CheckObjectTrait;
use tests\unit\ComplexObjects\_testObjects\DetailsPage;
use tests\unit\ComplexObjects\_testObjects\DetailsPage2;
use tests\unit\ComplexObjects\_testObjects\ImageContent;
use tests\unit\ComplexObjects\_testObjects\ImageContentData;
use tests\unit\ComplexObjects\_testObjects\PolyContent;
use tests\unit\ComplexObjects\_testObjects\TextContent;
use tests\unit\ComplexObjects\_testObjects\TextContentData;
use tests\unit\ComplexObjects\_testObjects\TitleContent;
use tests\unit\ComplexObjects\_testObjects\TitleContentData;
use tests\unit\Factory\ComplexObjects\_testObjects\DetailsPage3;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class ObjectPropertyIsClassUnionTest extends TestCase
{
    use CheckObjectTrait;

    /**
     * Проверяем кейс когда полиморфный объект лежит не в массиве, а в свойстве
     */
    #[
        DataProvider('dataProvider'),
    ]
    public function testClassUnion($instance): void
    {
        $this->checkObject($instance);
    }

    public static function dataProvider(): array
    {
        return [
            ['instance' => new PolyContent('text', (object)['text' => 'header'])],
            ['instance' => new PolyContent('null', null)],
            ['instance' => new PolyContent('text', new TextContentData('header'))], //получается некоторая тавтология, но работает
            ['instance' => new DetailsPage('test1', new TitleContent(TitleContent::TYPE, new TitleContentData('The best header in the world')))],
            ['instance' => new DetailsPage('test2', new ImageContent(ImageContent::TYPE, new ImageContentData('https://mydomain.com/image.png', 111_000)))],
            ['instance' => new DetailsPage('test3', new TextContent(TextContent::TYPE, new TextContentData('loremipsum page 2')))],
            ['instance' => (new DetailsPage2())->setTitle('test title')->setContent(new TitleContent(TitleContent::TYPE, new TitleContentData('The best header in the world')))],
            ['instance' => (new DetailsPage2())->setTitle('test title')->setContent(new ImageContent(ImageContent::TYPE, new ImageContentData('https://mydomain.com/image.png', 111_000)))],
            ['instance' => (new DetailsPage2())->setTitle('test title')->setContent(new TextContent(TextContent::TYPE, new TextContentData('loremipsum page 3')))],
        ];

    }

}
