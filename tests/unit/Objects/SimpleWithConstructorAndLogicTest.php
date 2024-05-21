<?php
declare(strict_types=1);

namespace tests\unit\Objects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\_testObjects\DTOWithConstructorAndLogic;
use tests\unit\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class SimpleWithConstructorAndLogicTest extends TestCase
{

    use CheckObjectTrait;

    public function testSimpleWithConstructorAndLogic(): void
    {
        $instance = new DTOWithConstructorAndLogic(
            title: 'John',
        );

        $jsonData = (object)['title' => 'John'];

        $newInstance = $instance::getHydratorFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
