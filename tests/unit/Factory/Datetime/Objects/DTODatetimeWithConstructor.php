<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use Dentelis\Hydrator\Factory\DTOFactoryTraitInterface;

class DTODatetimeWithConstructor implements DTOFactoryTraitInterface
{

    use DTOFactoryTrait;

    public function __construct(
        public string    $title,
        public DateTime  $dateTimeRequired,
        public ?DateTime $dateTimeNullable,
        public ?DateTime $dateTimeNullableIsNull = null
    )
    {
    }
}