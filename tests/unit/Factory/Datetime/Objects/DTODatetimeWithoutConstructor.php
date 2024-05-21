<?php

namespace tests\unit\Factory\Datetime\Objects;

use DateTime;
use Lbaf\Factory\DTOFactoryTrait;
use Lbaf\Factory\DTOFactoryTraitInterface;

class DTODatetimeWithoutConstructor implements DTOFactoryTraitInterface
{
    use DTOFactoryTrait;

    public string $title;
    public DateTime $dateTimeRequired;
    public ?DateTime $dateTimeNullable;
    public ?DateTime $dateTimeNullableIsNull = null;

}