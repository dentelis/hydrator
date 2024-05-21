<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Exception;

use Exception;
use ReflectionParameter;
use ReflectionProperty;

/**
 * @deprecated
 * @todo разбить на более понятные исключения
 */
class RequiredArgumentException extends Exception
{
    function __construct(ReflectionParameter|ReflectionProperty $param)
    {
        parent::__construct('Required argument "' . $param->getName() . '" (' . $param->getType()->getName() . ') is missing or invalid');
    }
}