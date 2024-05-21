<?php
declare(strict_types=1);

namespace tests\unit\Factory;

use Dentelis\Hydrator\Factory\HydratorFactory;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use tests\unit\Factory\_testObjects\DTODefaultValuesWithoutConstructor;
use tests\unit\Factory\_traits\CheckObjectTrait;

#[
    CoversClass(HydratorFactory::class),
    CoversClass(HydratorFactoryTrait::class),
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
