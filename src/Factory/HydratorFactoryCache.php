<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Factory;

class HydratorFactoryCache
{
    /**
     * @var HydratorFactory[]
     */
    static private array $factoryCache = [];

    static public function getFactory(string $className): HydratorFactory
    {
        if (!isset(self::$factoryCache[$className])) {
            self::$factoryCache[$className] = new HydratorFactory($className);
        }

        return self::$factoryCache[$className];
    }
}