<?php
declare(strict_types=1);

namespace Lbaf\Container\Exception;

class InjectArgumentTypeException extends \Exception
{
    function __construct(string $message)
    {
        parent::__construct($message);
    }
}