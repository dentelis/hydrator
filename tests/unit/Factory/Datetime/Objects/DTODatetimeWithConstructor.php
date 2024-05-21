<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Lbaf\Factory\DTOFactoryTrait;
use Lbaf\Factory\DTOFactoryTraitInterface;

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