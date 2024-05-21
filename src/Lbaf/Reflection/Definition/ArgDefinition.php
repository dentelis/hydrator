<?php

namespace Lbaf\Reflection\Definition;

use ReflectionParameter;
use ReflectionProperty;

class ArgDefinition
{
    public string $title;

    /**
     * @var DefinitionType Типизация типа: простой тип / enum / объект / массив
     */
    public DefinitionType $definitionType;

    /**
     * @var string|string[] непосредственно тип который
     */
    public string|array $argType;

    public mixed $defaultValue;
    public bool $mustBeOverwritten;
    public ReflectionProperty|ReflectionParameter $reflection;
}