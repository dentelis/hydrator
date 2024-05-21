<?php

namespace Lbaf\Reflection;

use DateTime;
use Lbaf\Container\Exception\InjectArgumentTypeException;
use Lbaf\Container\Exception\InjectRequiredArgumentException;
use Lbaf\Factory\Attribute\ArrayTypeOf;
use Lbaf\Reflection\Definition\ArgDefinition;
use Lbaf\Reflection\Definition\ClassDefinition;
use Lbaf\Reflection\Definition\DefinitionType;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionEnum;
use ReflectionException;
use ReflectionParameter;
use ReflectionProperty;
use ReflectionUnionType;
use Throwable;
use ValueError;

/**
 * Известные проблемы
 *  - не работает если есть объединение типов
 * @todo написать свои reflection property/parameter без косяков php
 */
class ReflectionClassCreator
{

    /**
     * @var ClassDefinition[];
     */
    static protected $definitionCache = [];

    protected static function createClassFromDefinition(ClassDefinition $classDefinition, object $jsonData): object
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
                    throw new InjectRequiredArgumentException($param->reflection);
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
            case DefinitionType::SIMPLE:
                return self::_formatSimple($param->argType, $value);

            case DefinitionType::ENUM:
                try {
                    return self::_formatEnum($param->argType, $value);
                } catch (Throwable $e) {
                    //не смогли найти такой - тут раньше был ValueError но почему-то он не кидается
                    throw new InjectRequiredArgumentException($param->reflection);
                }

            case DefinitionType::OBJECT:
                //@todo говнокодное решение чтобы делать union в свойствах класса
                if (is_array($param->argType)) {
                    $lastClass = end($param->argType);
                    foreach ($param->argType as $targetClass) {
                        try {
                            return self::createClassFromData(
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
                    return self::createClassFromData(
                        $param->argType,
                        is_object($value) ? $value : (object)$value,
                    );
                }

            case DefinitionType::ARRAY:
                if (!is_array($value)) {
                    throw new InjectArgumentTypeException($param->title . " must be an array");
                }
                return self::createArrayFromData($param->argType, $value, $param->reflection);
        }
    }

    protected static function _formatSimple(string $targetType, mixed $value): mixed
    {
        //@todo использовать gettype плохо, он возвращает устаревшие названия (например boolean вместо bool) - нужно везде перейти на reflection
        return (gettype($value) !== 'NULL' && gettype($value) != $targetType) ? ReflectionHelper::mixedToType($value, $targetType) : $value;
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
            return $targetType::from(ReflectionHelper::mixedToType($value, $innerType));
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
    public static function createClassFromData(string $className, object $jsonData): object
    {
        //особые кейсы встроенных классов
        //@todo подумать как реализовать встроенные классы типа DateTime
        if ($className === 'DateTime' && !empty($jsonData->scalar)) {
            return new DateTime($jsonData->scalar);
        }


        return self::createClassFromDefinition(
            self::getClassDefinition($className),
            $jsonData
        );
    }

    /**
     * Генерируем определение класса в формате удобном для генерации
     * Используем кеш
     */
    protected static function getClassDefinition(string $className): ClassDefinition
    {
        if (isset(self::$definitionCache[$className])) {
            return self::$definitionCache[$className];
        }

        //1. получаем класс reflection
        $classReflection = new ReflectionClass($className);
        $result = new ClassDefinition();
        $result->reflection = $classReflection;

        //2. пытаемся собрать данные для конструктора
        $constructorReflection = $classReflection->getConstructor();
        if ($constructorReflection) {

            //сначала собираем типизацию массивов если она есть
            $constructorArrayParametersType = [];
            $constructorAttributes = $constructorReflection->getAttributes(ArrayTypeOf::class, ReflectionAttribute::IS_INSTANCEOF);
            foreach ($constructorAttributes as $constructorAttribute) {
                /**
                 * @var ArrayTypeOf $attribute
                 */
                $attribute = $constructorAttribute->newInstance();
                $constructorArrayParametersType[$attribute->param] = $attribute->targetClass;
            }

            $result->constructorArgs = [];
            foreach ($constructorReflection->getParameters() as $parameterReflection) {
                $result->constructorArgs[$parameterReflection->getName()] = self::createArgDefinitionFromReflection(
                    $parameterReflection,
                    $constructorArrayParametersType,
                );
            }
        }

        $propertiesReflection = $classReflection->getProperties();
        foreach ($propertiesReflection as $propertyReflection) {
            if ($propertyReflection->isStatic() || $propertyReflection->isPrivate() || $propertyReflection->isProtected()) {
                //не переопределяем лишнее
                continue;
            }

            $propertyName = $propertyReflection->getName();
            if (isset($result->constructorArgs[$propertyName])) {
                //пропускаем т.к уже задано через конструктор
                continue;
            }

            $result->properties[] = self::createArgDefinitionFromReflection($propertyReflection);
        }

        self::$definitionCache[$className] = $result;

        return $result;

    }

    protected static function createArgDefinitionFromReflection(
        ReflectionProperty|ReflectionParameter $reflection,
        ?array                                 $constructorArrayParametersType = null,
    ): ArgDefinition
    {

        $tmp = new ArgDefinition();
        $tmp->title = $reflection->getName();
        $tmp->reflection = $reflection;

        if ($reflection instanceof ReflectionProperty ? $reflection->hasDefaultValue() : $reflection->isDefaultValueAvailable()) {
            $tmp->defaultValue = $reflection->getDefaultValue();
            $tmp->mustBeOverwritten = false;
        } elseif ($reflection instanceof ReflectionProperty ? $reflection->getType()->allowsNull() : $reflection->allowsNull()) {
            $tmp->defaultValue = null;
            $tmp->mustBeOverwritten = false;
        } else {
            $tmp->mustBeOverwritten = true;
        }

        if (!$reflection->hasType()) {
            $tmp->definitionType = DefinitionType::SIMPLE;
            $tmp->argType = 'mixed';
        } else {
            $type = $reflection->getType();
            if ($type instanceof ReflectionUnionType) {
                //@todo лютый говнокод, временное решение, нужно переделать
                //текущий код вообще не умеет в union type нормально, поэтому приходится изображать жесткую типизацию на основе первого
                $types = $type->getTypes();
                $tmp->argType = [];
                foreach ($types as $type) {
                    $typeName = $type->getName();
                    //@todo говнокод. определяем тип поля по последнему из union.
                    //      будет ломаться если сделать объединение enum|object
                    //      будет ломаться если будет любая типизация отличная от enum|enum|... или object|object|...
                    if (enum_exists($typeName)) {
                        $tmp->definitionType = DefinitionType::ENUM;
                        $tmp->argType[] = $typeName;
                    } else {
                        $tmp->definitionType = DefinitionType::OBJECT;
                        $tmp->argType[] = $typeName;
                    }
                }
                return $tmp;
            }

            $type = $reflection->getType()->getName();
            switch ($type) {
                case 'int':
                case 'bool':
                case 'string':
                case 'float':
                case 'mixed':
                    $tmp->definitionType = DefinitionType::SIMPLE;
                    $tmp->argType = $type;
                    break;
                case 'array':
                    $tmp->definitionType = DefinitionType::ARRAY;

                    //определяем тип вложения в массив
                    if ($reflection instanceof ReflectionProperty) {
                        //это свойство класса
                        $attribute = $reflection->getAttributes(ArrayTypeOf::class, ReflectionAttribute::IS_INSTANCEOF);
                        if (count($attribute)) {
                            $arrayTypeOfAttribute = $attribute[0]->newInstance();
                            $tmp->argType = $arrayTypeOfAttribute->targetClass;
                        } else {
                            $tmp->argType = 'mixed';
                        }
                    } else {
                        //это параметр конструктора
                        $tmp->argType = $constructorArrayParametersType[$tmp->title] ?? 'mixed';
                    }
                    break;
                default:
                    //это вероятно класс или enum
                    if (enum_exists($type)) {
                        $tmp->definitionType = DefinitionType::ENUM;
                        $tmp->argType = $type;
                    } else {
                        $tmp->definitionType = DefinitionType::OBJECT;
                        $tmp->argType = $type;
                    }
                    break;
            }
        }
        return $tmp;
    }

    /**
     * @todo внедрить кеширование
     * @todo внедрить нормальную ошибку если не удается создать enum
     * @todo переиспользовать эту функцию чтобы не было дублирования кода
     * @todo как грязная идея - сделать фейковый definition из объекта с массивом с одним типом, заюзать основную функцию и потом вывести свойство
     */
    public static function createArrayFromData(string|array $targetClassArr, array $jsonData, ReflectionParameter|ReflectionProperty $reflection): array
    {
        $result = [];

        if (is_array($targetClassArr)) {
            //попытка угадать тип массива

            $targetClassArr = (is_array($targetClassArr)) ? $targetClassArr : [$targetClassArr];
            $definitionTypes = [];
            foreach ($targetClassArr as $targetClass) {
                $definitionTypes[$targetClass] = self::getDefinitionTypeFromTargetClassname($targetClass);
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
            $definitionType = self::getDefinitionTypeFromTargetClassname($targetClassArr);
            foreach ($jsonData as $item) {
                $result[] = self::_createArrItem($definitionType, $targetClassArr, $item, $reflection);
            }
        }

        return $result;
    }

    /**
     * Определяет что собственно это такое
     * @todo текущий код сломается на объединении типов
     */
    protected static function getDefinitionTypeFromTargetClassname(string $targetClass): DefinitionType
    {
        return match ($targetClass) {
            'int', 'bool', 'string', 'float', 'mixed' => DefinitionType::SIMPLE,
            default => enum_exists($targetClass) ? DefinitionType::ENUM : DefinitionType::OBJECT,
        };
    }

    protected static function _createArrItem(DefinitionType $definitionType, string $targetClass, mixed $item, ReflectionParameter|ReflectionProperty $reflection): mixed
    {
        switch ($definitionType) {
            case DefinitionType::OBJECT:
                $tmp = self::createClassFromData(
                    $targetClass,
                    is_object($item) ? $item : (object)$item,
                );
                break;
            case DefinitionType::SIMPLE:
                $tmp = self::_formatSimple($targetClass, $item);
                break;
            case DefinitionType::ENUM:
                try {
                    $tmp = self::_formatEnum($targetClass, $item);
                } catch (Throwable $e) {
                    //не смогли найти такой
                    throw new InjectRequiredArgumentException($reflection);
                }
                break;
            default:
                //@todo придумать новую ошибку
                throw new InjectRequiredArgumentException($targetClass);
                break;
        }
        return $tmp;
    }

}