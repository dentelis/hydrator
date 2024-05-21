<?php

namespace Dentelis\Hydrator\Factory;

interface HydratorFactoryTraitInterface
{
    static public function getHydratorFactory(): HydratorFactory;
    public static function createHydratedObject(mixed $data): static;
}