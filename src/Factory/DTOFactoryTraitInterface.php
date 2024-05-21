<?php

namespace Dentelis\Hydrator\Factory;

interface DTOFactoryTraitInterface
{
    static public function getFactory(): DTOFactory;
    public static function createHydratedObject(mixed $data): static;
}