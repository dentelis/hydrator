<?php

namespace Lbaf\Factory\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class ArrayTypeOf
{
    /**
     * @var string|string[]
     */
    public string|array $targetClass;
    public ?string $param = null;

    public function __construct(string|array $paramOrTargetClass, string|array|null $targetClass = null)
    {
        if (is_null($targetClass)) {
            $this->targetClass = $paramOrTargetClass;
            $this->param = null;
        } else {
            $this->targetClass = $targetClass;
            $this->param = $paramOrTargetClass;
        }
    }
}
