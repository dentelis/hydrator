<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructorAndProperties;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
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
