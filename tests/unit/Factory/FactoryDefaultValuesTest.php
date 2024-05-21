<?php
declare(strict_types=1);

namespace tests\unit\Factory;

use Dentelis\Hydrator\Factory\DTOFactory;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTODefaultValuesWithoutConstructor;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(DTOFactory::class),
    CoversClass(DTOFactoryTrait::class),
]
final class FactoryDefaultValuesTest extends TestCase
{

    use CheckObjectTrait;

    public function testDefaultValues(): void
    {
        $instance = new DTODefaultValuesWithoutConstructor();
        $this->checkObject($instance);
    }

}
