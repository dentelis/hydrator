<?php
declare(strict_types=1);

namespace tests\unit\Objects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\_testObjects\DTOWithConstructor;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;
use tests\unit\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class SimpleWithConstructorTest extends TestCase
{

    use CheckObjectTrait;

    public function testSimpleWithConstructor(): void
    {
        $instance = new DTOWithConstructor(
            title: 'John',
            age: 30,
            isActive: true,
            intEnum: IntEnum::BLUE_COLOR,
            stringEnum: StringEnum::BLUE_COLOR,
        );

        $this->checkObject($instance);
    }

}
