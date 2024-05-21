<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Exception;

use Exception;

class ArgumentTypeException extends Exception
{
    function __construct(string $message)
    {
        parent::__construct($message);
    }
}