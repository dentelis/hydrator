<?php
declare(strict_types=1);

namespace tests\unit\Objects;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\_testObjects\DTOWithUntypedEn;
use tests\unit\_testObjects\Enums\UnbakedEnum;
use tests\unit\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class SimpleWithUntypedEnumTest extends TestCase
{

    use CheckObjectTrait;

    public function testUntypedEnum(): void
    {
        $instance = new DTOWithUntypedEn();
        $instance->enum = UnbakedEnum::GREEN;

        $jsonData = (object)['enum' => 'GREEN'];

        $newInstance = $instance::getHydratorFactory()->createObject($jsonData);

        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
