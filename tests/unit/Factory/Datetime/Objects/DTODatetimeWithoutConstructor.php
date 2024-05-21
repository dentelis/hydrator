<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Dentelis\Hydrator\Factory\DTOFactoryTrait;
use Dentelis\Hydrator\Factory\DTOFactoryTraitInterface;

class DTODatetimeWithoutConstructor implements DTOFactoryTraitInterface
{
    use DTOFactoryTrait;

    public string $title;
    public DateTime $dateTimeRequired;
    public ?DateTime $dateTimeNullable;
    public ?DateTime $dateTimeNullableIsNull = null;

}