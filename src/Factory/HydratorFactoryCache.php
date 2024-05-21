<?php

namespace Dentelis\Hydrator\Factory;

class HydratorFactoryCache
{
    /**
     * @var HydratorFactory[]
     */
    static private array $factoryCache = [];

    static public function getFactory(string $className): HydratorFactory
    {
        if (!isset(static::$factoryCache[$className])) {
            static::$factoryCache[$className] = new HydratorFactory($className);
        }
        return static::$factoryCache[$className];
    }
}