<?php

namespace Dentelis\Hydrator\Factory;

/**
 * @implements HydratorFactoryTraitInterface
 */
trait HydratorFactoryTrait
{
    static public function getHydratorFactory(): HydratorFactory
    {
        //мы используем DTOFactoryCache чтобы у нас был единый реестр DTO фабрик, не важно из какого класса он вызван
        return HydratorFactoryCache::getFactory(static::class);
    }

    public static function createHydratedObject(mixed $data): static {
        return static::getHydratorFactory()->createObject($data);
    }

}