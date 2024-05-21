<?php
declare(strict_types=1);

namespace Lbaf\Container\Exception;

use ReflectionParameter;
use ReflectionProperty;

class InjectArrayTypeUnspecifiedException extends \Exception
{
    function __construct(ReflectionParameter|ReflectionProperty $param)
    {
        parent::__construct('Array "' . $param->getName() . '" type MUST be specified in source code.');
    }
}