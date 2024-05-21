<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructorAndProperties;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class SimpleWithConstructorAndPropertiesTest extends TestCase
{

    use CheckObjectTrait;

    public function testSimpleWithConstructorAndProperties(): void
    {
        $instance = new DTOWithConstructorAndProperties(
            title: 'John',
            age: 30,
            intEnum: IntEnum::BLUE_COLOR,
        );
        $instance->isActive = true;
        $instance->stringEnum = StringEnum::BLUE_COLOR;

        $this->checkObject($instance);
    }


}