<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle:true,
        typeDeclarations: true,
        privatization:true,
        naming: false, //change variable names to class names
        instanceOf: true, //unclear
        earlyReturn: false, //need review
        strictBooleans: true,
        carbon: false, //https://carbon.nesbot.com/docs/
    );
