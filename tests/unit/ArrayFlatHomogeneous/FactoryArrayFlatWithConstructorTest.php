<?php
declare(strict_types=1);

namespace tests\unit\ArrayFlatHomogeneous;

use Dentelis\Hydrator\Exception\RequiredArgumentException;
use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\_testObjects\DTOWithConstructor;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;
use tests\unit\_traits\CheckObjectTrait;
use tests\unit\ArrayFlatHomogeneous\DTO\DTOArrayHomogeneousWithConstructor;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class FactoryArrayFlatWithConstructorTest extends TestCase
{

    use CheckObjectTrait;

    public static function badProvider(): array
    {
        return [
            [(object)['untypedEnums' => ['OLOLO']]],
            [(object)['ololo' => ['GREEN']]],
            [(object)[]],
        ];
    }

    public function testArray(): void
    {
        $instance = new DTOArrayHomogeneousWithConstructor(
            stringEnums: [StringEnum::RED_COLOR, StringEnum::GREEN_COLOR],
            intEnums: [IntEnum::GREEN_COLOR, IntEnum::BLUE_COLOR],
            strings: ['blue', 'green'],
            objects: [
                new DTOWithConstructor(
                    title: 'John',
                    age: 30,
                    isActive: true,
                    intEnum: IntEnum::BLUE_COLOR,
                    stringEnum: StringEnum::BLUE_COLOR,
                ),
                new DTOWithConstructor(
                    title: 'Mike',
                    age: 10,
                    isActive: false,
                    intEnum: IntEnum::GREEN_COLOR,
                    stringEnum: StringEnum::GREEN_COLOR,
                )
            ],
        );

        $this->checkObject($instance);
    }

    #[DataProvider('badProvider')]
    public function testException(object $jsonData): void
    {

        $this->expectException(RequiredArgumentException::class);
        DTOArrayHomogeneousWithConstructor::getHydratorFactory()->createObject($jsonData);

    }


}
