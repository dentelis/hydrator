<?php
declare(strict_types=1);

namespace tests\unit\Factory\Objects;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTOWithUntypedEn;
use tests\unit\Factory\_testObjects\Enums\UntypedEnum;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class SimpleWithUntypedEnumTest extends TestCase
{

    use CheckObjectTrait;

    public function testUntypedEnum(): void
    {
        $instance = new DTOWithUntypedEn();
        $instance->enum = UntypedEnum::GREEN;

        $jsonData = (object)['enum' => 'GREEN'];

        $newInstance = $instance::getFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
