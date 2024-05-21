<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Dentelis\Hydrator\Factory\HydratorFactoryTrait;
use Dentelis\Hydrator\Factory\HydratorFactoryTraitInterface;

class HydratorDatetimeWithConstructor implements HydratorFactoryTraitInterface
{

    use HydratorFactoryTrait;

    public function __construct(
        public string    $title,
        public DateTime  $dateTimeRequired,
        public ?DateTime $dateTimeNullable,
        public ?DateTime $dateTimeNullableIsNull = null
    )
    {
    }
}