<?php
declare(strict_types=1);

namespace tests\unit\Factory\_traits;

use Lbaf\Factory\DTOFactoryTraitInterface;
use PHPUnit\Framework\TestCase;

trait CheckObjectTrait
{

    protected function checkObject(object $instance): void
    {
        /**
         * @var DTOFactoryTraitInterface $instance
         * @var TestCase $this
         */
        $jsonData = json_decode(json_encode($instance));

        //we have 2 ways to create object
        $newInstance = $instance::createHydratedObject($jsonData);
        $this->assertEqualsCanonicalizing($instance, $newInstance);

        $newInstance = $instance::getFactory()->createObject($jsonData);
        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
