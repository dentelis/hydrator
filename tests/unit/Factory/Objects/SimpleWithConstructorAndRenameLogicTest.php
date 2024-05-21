<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructorAndRenameLogic;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class SimpleWithConstructorAndRenameLogicTest extends TestCase
{

    use CheckObjectTrait;

    public function testSimpleWithConstructorAndRenameLogic(): void
    {
        $this->markTestIncomplete('@todo');

        $instance = new DTOWithConstructorAndRenameLogic(
            title: 'John',
        );

        $jsonData = (object)['title' => 'John'];

        $newInstance = $instance::getHydratorFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }

}
