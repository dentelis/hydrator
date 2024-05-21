<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Dentelis\Hydrator\Factory\DTOFactory;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
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
