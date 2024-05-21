<?php

namespace Lbaf\Factory;

/**
 * @implements DTOFactoryTraitInterface
 */
trait DTOFactoryTrait
{
    static public function getFactory(): DTOFactory
    {
        //мы используем DTOFactoryCache чтобы у нас был единый реестр DTO фабрик, не важно из какого класса он вызван
        return DTOFactoryCache::getFactory(static::class);
    }

    public static function createHydratedObject(mixed $data): static {
        return static::getFactory()->createObject($data);
    }

}