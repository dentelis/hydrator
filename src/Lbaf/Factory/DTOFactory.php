<?php

namespace Lbaf\Factory;

use Lbaf\Container\Exception\InjectRequiredArgumentException;
use Lbaf\Reflection\ReflectionClassCreator;

class DTOFactory
{
    function __construct(protected string $className)
    {
    }

    /**
     * Создает массив объектов на основе данных в структуре $jsonData
     * @param array $jsonDataArray массив объектов|массивов описывающих возвращаемые объекты
     * @return array
     */
    public function createArray(array $jsonDataArray): array
    {
        $result = [];
        foreach ($jsonDataArray as $item) {
            $result[] = $this->createObject($item);
        }
        return $result;
    }

    /**
     * Создает экземпляр объекта на основе данных в структуре $jsonData
     * @param object|array $jsonData структура описывающая объект. Массив будет преобразован в объект.
     * @return object
     * @throws InjectRequiredArgumentException
     */
    public function createObject(object|array $jsonData): object
    {
        if (is_array($jsonData)) {
            $jsonData = (object)$jsonData;
        }
        return ReflectionClassCreator::createClassFromData(
            $this->className,
            $jsonData
        );
    }

}