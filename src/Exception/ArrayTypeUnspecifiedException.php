<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Exception;

use ReflectionParameter;
use ReflectionProperty;

class ArrayTypeUnspecifiedException extends \Exception
{
    function __construct(ReflectionParameter|ReflectionProperty $param)
    {
        parent::__construct('Array "' . $param->getName() . '" type MUST be specified in source code.');
    }
}