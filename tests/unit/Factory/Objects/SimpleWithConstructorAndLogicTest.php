<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructorAndLogic;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
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

        $newInstance = $instance::getFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
