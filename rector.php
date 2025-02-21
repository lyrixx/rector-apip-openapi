<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    ->withPhpSets(php83: true)
    ->withTypeCoverageLevel(\PHP_INT_MAX)
    ->withDeadCodeLevel(\PHP_INT_MAX)
    ->withCodeQualityLevel(\PHP_INT_MAX)
    ->withRules([
        // add your custom rules here
    ])
;
