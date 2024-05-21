<?php

namespace tests\unit\_testObjects;

use Dentelis\Hydrator\Attribute\ArrayTypeOf;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use tests\unit\_testObjects\Enums\IntEnum;
use tests\unit\_testObjects\Enums\StringEnum;

class DTODefaultValuesWithoutConstructor
{
    use HydratorFactoryTrait;

    public string $emptyString = '';
    public string $nonEmptyString = 'abc';
    public ?string $nullableStringNull = null;

    public int $intZero = 0;
    public int $intNotZero = 999;
    public ?int $intNullableNull = null;

    #[ArrayTypeOf(StringEnum::class)]
    public array $stringEnums1 = [];
    #[ArrayTypeOf(IntEnum::class)]
    public array $intEnums1 = [];
    #[ArrayTypeOf('string')]
    public array $strings1 = [];
    #[ArrayTypeOf(DTOWithConstructor::class)]
    public array $objects1 = [];

    #[ArrayTypeOf(StringEnum::class)]
    public ?array $stringEnums1n = [];
    #[ArrayTypeOf(IntEnum::class)]
    public ?array $intEnums1n = [];
    #[ArrayTypeOf('string')]
    public ?array $strings1n = [];
    #[ArrayTypeOf(DTOWithConstructor::class)]
    public ?array $objects1n = [];

    #[ArrayTypeOf(StringEnum::class)]
    public array $stringEnums2 = [StringEnum::GREEN_COLOR, StringEnum::BLUE_COLOR,];
    #[ArrayTypeOf(IntEnum::class)]
    public array $intEnums2 = [IntEnum::GREEN_COLOR, IntEnum::BLUE_COLOR,];
    #[ArrayTypeOf('string')]
    public array $strings2 = ['aaa', 'bbb'];
    #[ArrayTypeOf('bool')]
    public array $bools2 = [true, true, false];

    #[ArrayTypeOf(StringEnum::class)]
    public ?array $stringEnums3 = [StringEnum::GREEN_COLOR, StringEnum::BLUE_COLOR,];
    #[ArrayTypeOf(IntEnum::class)]
    public ?array $intEnums3 = [IntEnum::GREEN_COLOR, IntEnum::BLUE_COLOR,];
    #[ArrayTypeOf('string')]
    public ?array $strings3 = ['aaa', 'bbb'];

    #[ArrayTypeOf(StringEnum::class)]
    public ?array $stringEnumsNull = null;
    #[ArrayTypeOf(IntEnum::class)]
    public ?array $intEnumsNull = null;
    #[ArrayTypeOf('string')]
    public ?array $stringsNull = null;
    #[ArrayTypeOf(DTOWithConstructor::class)]
    public ?array $objectsNull = null;

}