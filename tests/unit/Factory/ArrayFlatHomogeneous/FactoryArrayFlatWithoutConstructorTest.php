<?php
declare(strict_types=1);

namespace tests\unit\Factory\ArrayFlatHomogeneous;

use Lbaf\Container\Exception\InjectRequiredArgumentException;
use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_testObjects\Enums\UntypedEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;
use tests\unit\Factory\ArrayFlatHomogeneous\DTO\DTOArrayHomogeneousUntypedEnumsWithoutConstructor;
use tests\unit\Factory\ArrayFlatHomogeneous\DTO\DTOArrayHomogeneousWithoutConstructor;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class FactoryArrayFlatWithoutConstructorTest extends TestCase
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
        $instance = new DTOArrayHomogeneousWithoutConstructor();
        $instance->stringEnums = [StringEnum::RED_COLOR, StringEnum::GREEN_COLOR];
        $instance->strings = ['blue', 'green'];
        $instance->intEnums = [IntEnum::GREEN_COLOR, IntEnum::BLUE_COLOR];
        $instance->objects = [
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
        ];

        $this->checkObject($instance);
    }

    public function testArrayUntypedEnum(): void
    {
        $instance = new DTOArrayHomogeneousUntypedEnumsWithoutConstructor();
        $instance->untypedEnums = [UntypedEnum::GREEN];

        $jsonData = (object)['untypedEnums' => ['GREEN']];

        $newInstance = $instance::getFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }

    #[DataProvider('badProvider')]
    public function testException(object $jsonData): void
    {
        $this->expectException(InjectRequiredArgumentException::class);
        DTOArrayHomogeneousUntypedEnumsWithoutConstructor::getFactory()->createObject($jsonData);
    }


}