<?php
declare(strict_types=1);

namespace Lbaf\Reflection;

class ReflectionHelper
{
    /**
     * Конвертирует строку в нужный тип
     * @param string $data
     * @param string $type
     * @return mixed
     * @todo убрать отсюда
     */
    public static function mixedToType(mixed $data, string $type): mixed
    {
        //@todo написать преобразователь array
        //@todo кидать ошибку если это object/ resource / unknown type / null  https://www.php.net/manual/ru/function.gettype.php
        //@todo поддерживать некоторые стандартные object, например DateTime
        return match ($type) {
            'boolean', 'bool' => ((is_string($data) && strtolower($data) === 'true') || $data === '1' || $data === true || $data === 1),
            'integer', 'int' => (int)$data,
            'double', 'float' => (float)$data,
            'string' => (string)$data,
            default => $data,
        };
    }

}
