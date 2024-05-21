<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithoutConstructor;
use tests\unit\Factory\_testObjects\Enums\IntEnum;
use tests\unit\Factory\_testObjects\Enums\StringEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class  SimpleWithoutConstructorTest extends TestCase
{
    use CheckObjectTrait;

    public function testSimpleWithoutConstructor(): void
    {

        $instance = new DTOWithoutConstructor();
        $instance->title = 'John';
        $instance->age = 30;
        $instance->isActive = true;

        $instance->intEnum = IntEnum::BLUE_COLOR;
        $instance->stringEnum = StringEnum::BLUE_COLOR;

        $this->checkObject($instance);
    }

}
