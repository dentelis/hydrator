<?php

namespace Dentelis\Hydrator;

use DateTime;
use Dentelis\Hydrator\Definition\ArgDefinition;
use Dentelis\Hydrator\Definition\ClassDefinition;
use Dentelis\Hydrator\Definition\DefinitionType;
use Dentelis\Hydrator\Exception\ArgumentTypeException;
use Dentelis\Hydrator\Exception\RequiredArgumentException;
use ReflectionEnum;
use ReflectionException;
use ReflectionParameter;
use ReflectionProperty;
use Throwable;
use ValueError;

/**
 * @todo написать свои reflection property/parameter без косяков php
 * @todo refactor
 */
class Hydrator
{

    protected static function createObjectFromDefinition(ClassDefinition $classDefinition, object $jsonData): object
    {

        //собираем данные для конструктора
        $constructorArgs = [];
        if (is_array($classDefinition->constructorArgs)) {
            //нужны переменные конструктора
            $constructorArgs = self::fillArgs($classDefinition->constructorArgs, $jsonData);
        }

        //создаем класс
        $classInstance = $classDefinition->reflection->newInstanceArgs($constructorArgs);

        //патчим свойства класса
        $properties = self::fillArgs($classDefinition->properties, $jsonData);

        foreach ($properties as $key => $value) {
            $classInstance->$key = $value;
        }

        return $classInstance;

    }

    /**
     * @param ArgDefinition[] $params
     */
    protected static function fillArgs(array $params, object $jsonData): array
    {
        $result = [];

        foreach ($params as $param) {
            if (!isset($jsonData->{$param->title})) {
                //если данные не пришли - проверяем нужны ли они были
                if ($param->mustBeOverwritten) {
                    throw new RequiredArgumentException($param->reflection);
                } else {
                    $result[$param->title] = $param->defaultValue;
                }
            } else {
                $result[$param->title] = self::extractArgFromData($param, $jsonData->{$param->title});
            }
        }
        return $result;
    }

    protected static function extractArgFromData(ArgDefinition $param, mixed $value)
    {
        switch ($param->definitionType) {
            case DefinitionType::SCALAR:
                return self::_formatSimple($param->argType, $value);

            case DefinitionType::ENUM:
                try {
                    return self::_formatEnum($param->argType, $value);
                } catch (Throwable $e) {
                    //не смогли найти такой - тут раньше был ValueError но почему-то он не кидается
                    throw new RequiredArgumentException($param->reflection);
                }

            case DefinitionType::OBJECT:
                //@todo не самое красивое решение чтобы делать union в свойствах класса
                if (is_array($param->argType)) {
                    $lastClass = end($param->argType);
                    foreach ($param->argType as $targetClass) {
                        try {
                            return self::createObjectFromData(
                                $targetClass,
                                is_object($value) ? $value : (object)$value,
                            );
                        } catch (Throwable $e) {
                            if ($targetClass == $lastClass) {
                                throw $e;
                            } else {
                                continue;
                            }
                        }
                    }

                } else {
                    return self::createObjectFromData(
                        $param->argType,
                        is_object($value) ? $value : (object)$value,
                    );
                }

            case DefinitionType::ARRAY:
                if (!is_array($value)) {
                    throw new ArgumentTypeException($param->title . " must be an array");
                }
                return self::createArrayFromData($param->argType, $value, $param->reflection);
        }
    }

    protected static function _formatSimple(string $targetType, mixed $value): mixed
    {
        //@todo использовать gettype плохо, он возвращает устаревшие названия (например boolean вместо bool) - нужно везде перейти на reflection
        return (gettype($value) !== 'NULL' && gettype($value) != $targetType) ? self::convertMixed($value, $targetType) : $value;
    }

    /**
     * @throws ValueError
     */
    protected static function _formatEnum(string $targetType, mixed $value): object
    {
        $enumReflection = new ReflectionEnum($targetType);
        if ($enumReflection->isBacked()) {
            //если у него есть тип, у него есть и значения
            $innerType = $enumReflection->getBackingType()->getName();
            return $targetType::from(self::convertMixed($value, $innerType));
        } else {
            return constant($targetType . '::' . $value);
        }
    }

    /**
     * Создает класс из переданных данных
     * Корректно обрабатывает как переменные конструктора, так и свойства класса (должны быть или публичными или явно поддерживаться через __set)
     * Корректно обрабатывает вложенные классы, enum, массивы
     * @param string $className
     * @param mixed $jsonData данные в json формате
     * @return object
     * @throws ReflectionException
     */
    public static function createObjectFromData(string $className, object $jsonData): object
    {
        //особые кейсы встроенных классов
        //@todo подумать как реализовать встроенные классы типа DateTime
        if ($className === 'DateTime' && !empty($jsonData->scalar)) {
            return new DateTime($jsonData->scalar);
        }


        return self::createObjectFromDefinition(
            Definition\DefinitionGenerator::getClassDefinition($className),
            $jsonData
        );
    }

    /**
     * @todo внедрить нормальную ошибку если не удается создать enum
     * @todo переиспользовать эту функцию чтобы не было дублирования кода
     * @todo как грязная идея - сделать фейковый definition из объекта с массивом с одним типом, заюзать основную функцию и потом вывести свойство
     */
    public static function createArrayFromData(string|array $targetClassArr, array $jsonData, ReflectionParameter|ReflectionProperty $reflection): array
    {
        $result = [];

        if (is_array($targetClassArr)) {
            //попытка угадать тип массива

            //@todo абзац ниже можно заменить на каунтер, будет сильно быстрее
            $targetClassArr = (is_array($targetClassArr)) ? $targetClassArr : [$targetClassArr];
            $definitionTypes = [];
            foreach ($targetClassArr as $targetClass) {
                $definitionTypes[$targetClass] = Definition\DefinitionGenerator::getDefinitionTypeFromTargetClassname($targetClass);
            }
            $lastClass = end($targetClassArr);

            foreach ($jsonData as $item) {
                //пробуем найти сопоставление
                foreach ($definitionTypes as $targetClass => $definitionType) {
                    try {
                        $tmp = self::_createArrItem($definitionType, $targetClass, $item, $reflection);
                    } catch (Throwable $e) {
                        if ($targetClass == $lastClass) {
                            throw $e;
                        } else {
                            continue; //не надо писать в result
                        }
                    }
                    $result[] = $tmp;
                    break; //мы нашли подходящий класс, выход из foreach ($definitionTypes
                }
            }

        } else {
            //@todo тут стоит переписать как было (foreach element внутри switch) - сейчас мы делаем лишний switch для каждого элемента
            $definitionType = Definition\DefinitionGenerator::getDefinitionTypeFromTargetClassname($targetClassArr);
            foreach ($jsonData as $item) {
                $result[] = self::_createArrItem($definitionType, $targetClassArr, $item, $reflection);
            }
        }

        return $result;
    }

    protected static function _createArrItem(DefinitionType $definitionType, string $targetClass, mixed $item, ReflectionParameter|ReflectionProperty $reflection): mixed
    {
        switch ($definitionType) {
            case DefinitionType::OBJECT:
                $tmp = self::createObjectFromData(
                    $targetClass,
                    is_object($item) ? $item : (object)$item,
                );
                break;
            case DefinitionType::SCALAR:
                $tmp = self::_formatSimple($targetClass, $item);
                break;
            case DefinitionType::ENUM:
                try {
                    $tmp = self::_formatEnum($targetClass, $item);
                } catch (Throwable $e) {
                    //не смогли найти такой
                    throw new RequiredArgumentException($reflection);
                }
                break;
            default:
                //@todo придумать новую ошибку
                throw new RequiredArgumentException($targetClass);
                break;
        }
        return $tmp;
    }

    /**
     * Конвертирует строку в нужный тип
     * @param string $data
     * @param string $targetType
     * @return mixed
     */
    protected static function convertMixed(mixed $data, string $targetType): mixed
    {
        //@todo написать преобразователь array
        //@todo кидать ошибку если это object/ resource / unknown type / null  https://www.php.net/manual/ru/function.gettype.php
        //@todo поддерживать некоторые стандартные object, например DateTime
        return match ($targetType) {
            'boolean', 'bool' => ((is_string($data) && strtolower($data) === 'true') || $data === '1' || $data === true || $data === 1),
            'integer', 'int' => (int)$data,
            'double', 'float' => (float)$data,
            'string' => (string)$data,
            default => $data,
        };
    }
}