<?php
declare(strict_types=1);

namespace tests\unit\Factory\ArrayFlatHomogeneous;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\Broken\DTOUntypedArrayParameter;
use tests\unit\Factory\_testObjects\Broken\DTOUntypedArrayProperty;
use tests\unit\Factory\_traits\CheckObjectTrait;


#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
]
final class FactoryArrayBrokenTest extends TestCase
{

    use CheckObjectTrait;

    public function testUnspecifiedProperty(): void
    {
        $instance = new DTOUntypedArrayProperty();
        $instance->arr = ['foo', 'bar',];

        $this->checkObject($instance);
    }

    public function testUnspecifiedParameter(): void
    {
        $instance = new DTOUntypedArrayParameter(['foo', 'bar',]);
        $this->checkObject($instance);
    }

}
