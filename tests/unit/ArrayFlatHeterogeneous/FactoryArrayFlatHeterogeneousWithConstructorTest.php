<?php
declare(strict_types=1);

namespace tests\unit\ArrayFlatHeterogeneous;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use Dentelis\Hydrator\Factory\HydratorFactoryTraitInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\ArrayFlatHeterogeneous\DTO\DTOArrayHeterogeneousWithConstructor;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\CarDTO;
use tests\unit\ArrayFlatHeterogeneous\DTO\Objects\DriverDTO;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class FactoryArrayFlatHeterogeneousWithConstructorTest extends TestCase
{

    public function testArray(): void
    {

        $instance = new DTOArrayHeterogeneousWithConstructor([
            DriverDTO::getHydratorFactory()->createObject(['name' => 'Dim', 'age' => 37,]),
            new CarDTO('bmw', 2023, DriverDTO::getHydratorFactory()->createObject(['name' => 'Mark', 'age' => 3,])),
            DriverDTO::getHydratorFactory()->createObject(['name' => 'Alex', 'age' => 35,]),
        ]);

        $this->checkObject($instance);
    }

    protected function checkObject(object $instance): void
    {
        /**
         * @var HydratorFactoryTraitInterface $instance
         */
        $jsonData = json_decode(json_encode($instance));
        $newInstance = $instance::getHydratorFactory()->createObject($jsonData);

        //пришлось убрать assertEqualsCanonicalizing - он пытается сделать sort массива и ломается т.к в массиве объекты
        $this->assertEquals($instance, $newInstance);
    }


}
