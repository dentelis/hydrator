<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Factory;

use Dentelis\Hydrator\Exception\RequiredArgumentException;
use Dentelis\Hydrator\Hydrator;

class HydratorFactory
{
    public function __construct(protected string $className)
    {
    }

    /**
     * Создает массив объектов на основе данных в структуре $jsonData
     * @param array $jsonDataArray массив объектов|массивов описывающих возвращаемые объекты
     */
    public function createArray(array $jsonArray): array
    {
        return Hydrator::createArrayFromData(
            $this->className,
            $jsonArray
        );
    }

    /**
     * Создает экземпляр объекта на основе данных в структуре $jsonData
     * @param object|array $jsonData структура описывающая объект. Массив будет преобразован в объект.
     * @throws RequiredArgumentException
     */
    public function createObject(object|array $jsonData): object
    {
        if (is_array($jsonData)) {
            $jsonData = (object)$jsonData;
        }

        return Hydrator::createObjectFromData(
            $this->className,
            $jsonData
        );
    }

}