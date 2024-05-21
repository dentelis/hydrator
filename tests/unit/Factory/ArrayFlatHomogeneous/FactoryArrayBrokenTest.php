<?php
declare(strict_types=1);

namespace tests\unit\Factory\ArrayFlatHomogeneous;

use Lbaf\Factory\DTOFactory;
use Lbaf\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\Broken\DTOUntypedArrayParameter;
use tests\unit\Factory\_testObjects\Broken\DTOUntypedArrayProperty;
use tests\unit\Factory\_traits\CheckObjectTrait;


#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
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
