<?php

namespace Dentelis\Hydrator\Factory;

class DTOFactoryCache
{
    /**
     * @var DTOFactory[]
     */
    static private array $factoryCache = [];

    static public function getFactory(string $className): DTOFactory
    {
        if (!isset(static::$factoryCache[$className])) {
            static::$factoryCache[$className] = new DTOFactory($className);
        }
        return static::$factoryCache[$className];
    }
}