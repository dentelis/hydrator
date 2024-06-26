<?php
declare(strict_types=1);

namespace tests\unit\_traits;

use Dentelis\Hydrator\Factory\HydratorFactoryTraitInterface;
use PHPUnit\Framework\TestCase;

trait CheckObjectTrait
{

    protected function checkObject(object $instance): void
    {
        /**
         * @var HydratorFactoryTraitInterface $instance
         * @var TestCase $this
         */
        $jsonData = json_decode(json_encode($instance));

        //we have 2 ways to create object
        $newInstance = $instance::createHydratedObject($jsonData);
        $this->assertEqualsCanonicalizing($instance, $newInstance);

        $newInstance = $instance::getHydratorFactory()->createObject($jsonData);
        $this->assertEqualsCanonicalizing($instance, $newInstance);
    }


}
