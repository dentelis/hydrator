<?php

namespace Lbaf\Factory;

interface DTOFactoryTraitInterface
{
    static public function getFactory(): DTOFactory;
    public static function createHydratedObject(mixed $data): static;
}