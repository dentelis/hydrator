<?php
declare(strict_types=1);

namespace tests\unit\Factory\ArrayFlatHeterogeneous;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use Lbaf\Factory\DTOFactoryTraitInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\DTOArrayHeterogeneousWithoutConstructor;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\Factory\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class FactoryArrayFlatHeterogeneousWithoutConstructorTest extends TestCase
{

    public function testArray(): void
    {

        $instance = new DTOArrayHeterogeneousWithoutConstructor();
        $instance->objects = [
            DriverDTO::getFactory()->createObject(['name' => 'Dim', 'age' => 37,]),
            new CarDTO('bmw', 2023, DriverDTO::getFactory()->createObject(['name' => 'Mark', 'age' => 3,])),
            DriverDTO::getFactory()->createObject(['name' => 'Alex', 'age' => 35,]),
        ];

        $this->checkObject($instance);
    }

    protected function checkObject(object $instance): void
    {
        /**
         * @var DTOFactoryTraitInterface $instance
         */
        $jsonData = json_decode(json_encode($instance));
        $newInstance = $instance::getFactory()->createObject($jsonData);

        //пришлось убрать assertEqualsCanonicalizing - он пытается сделать sort массива и ломается т.к в массиве объекты
        $this->assertEquals($instance, $newInstance);
    }


}
