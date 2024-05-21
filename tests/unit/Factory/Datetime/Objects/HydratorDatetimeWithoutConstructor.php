<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use Dentelis\Hydrator\Factory\HydratorFactoryTraitInterface;

class HydratorDatetimeWithoutConstructor implements HydratorFactoryTraitInterface
{
    use HydratorFactoryTrait;

    public string $title;
    public DateTime $dateTimeRequired;
    public ?DateTime $dateTimeNullable;
    public ?DateTime $dateTimeNullableIsNull = null;

}