<?php
declare(strict_types=1);

namespace Dentelis\Hydrator\Definition;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use ReflectionAttribute;
use ReflectionClass;
use ReflectionParameter;
use ReflectionProperty;
use ReflectionUnionType;

class DefinitionGenerator
{


    /**
     * @var ClassDefinition[];
     */
    static protected $definitionCache = [];

    /**
     * Генерируем определение класса в формате удобном для генерации
     * Используем кеш
     */
    public static function getClassDefinition(string $className): ClassDefinition
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
            $tmp->definitionType = DefinitionType::SCALAR;
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
                    $tmp->definitionType = DefinitionType::SCALAR;
                    $tmp->argType = $type;
                    break;
                case 'array':
                    $tmp->definitionType = DefinitionType::ARRAY;

                    //определяем тип вложения в массив
                    if ($reflection instanceof ReflectionProperty) {
                        //это свойство класса
                        $attribute = $reflection->getAttributes(ArrayTypeOf::class, ReflectionAttribute::IS_INSTANCEOF);
                        if ($attribute !== []) {
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
     * Определяет тип
     */
    public static function getDefinitionTypeFromTargetClassname(string $targetClass): DefinitionType
    {
        return match ($targetClass) {
            'int', 'bool', 'string', 'float', 'mixed' => DefinitionType::SCALAR,
            'array' => DefinitionType::ARRAY, //@todo есть подозрение что не используется
            default => enum_exists($targetClass) ? DefinitionType::ENUM : DefinitionType::OBJECT,
        };
    }
}