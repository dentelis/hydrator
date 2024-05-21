<?php

namespace tests\unit\Factory\_testObjects;

use Lbaf\Factory\DTOFactoryTrait;
use tests\unit\Factory\_testObjects\Enums\UntypedEnum;

class DTOWithUntypedEn
{
    use DTOFactoryTrait;

    public UntypedEnum $enum;

}
