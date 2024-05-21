<?php

namespace Lbaf\Reflection\Definition;

use ReflectionClass;

class ClassDefinition
{
    /**
     * @var ArgDefinition[]|null
     */
    public ?array $constructorArgs = null;

    /**
     * @var ArgDefinition[]
     */
    public array $properties = [];

    public ReflectionClass $reflection;
}