<?php
declare(strict_types=1);

namespace Lbaf\Container\Exception;

use ReflectionParameter;
use ReflectionProperty;

class InjectRequiredArgumentException extends \Exception
{
    function __construct(ReflectionParameter|ReflectionProperty $param)
    {
        parent::__construct('Required argument "' . $param->getName() . '" (' . $param->getType()->getName() . ') is missing or invalid');
    }
}