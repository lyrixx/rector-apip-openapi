<?php

use App\MyBetterStandardPrinter;
use Rector\Config\RectorConfig;
use Rector\NodeAnalyzer\ExprAnalyzer;
use Rector\PhpParser\Printer\BetterStandardPrinter;

$builder = static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(App\ApipMigrateOpenApiRector::class);
    $rectorConfig->importNames();
};

return static function (RectorConfig $config) use ($builder): void {
    $config->singleton(BetterStandardPrinter::class, fn ($app): \App\MyBetterStandardPrinter => new MyBetterStandardPrinter($app->get(ExprAnalyzer::class)));

    $builder($config);
};
