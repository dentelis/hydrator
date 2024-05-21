<?php
declare(strict_types=1);

namespace tests\unit\Factory\ArrayFlatHomogeneous;

use Dentelis\Hydrator\Exception\RequiredArgumentException;
use Dentelis\Hydrator\Factory\DTOFactory;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;
use tests\unit\Factory\ArrayFlatHomogeneous\DTO\DTOArrayHomogeneousWithConstructor;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
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
        DTOArrayHomogeneousWithConstructor::getFactory()->createObject($jsonData);

    }


}
