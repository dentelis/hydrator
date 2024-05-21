<?php

namespace Dentelis\Hydrator\Definition;

enum DefinitionType
{
    case SCALAR;
    case ARRAY;
    case OBJECT;
    case ENUM;
}
