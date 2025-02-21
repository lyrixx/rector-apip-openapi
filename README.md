# Rector rule for migration API-Platform OpenApiContext

Provide this kind of diff:
```diff
         new Get(
             // ...
-            openapiContext: [
-                'description' => 'Use this endpoint to retrieve the details of a draft rule.',
-                'operationId' => 'getDraft',
-            ]
+            openapi: new Operation(
+                description: 'Use this endpoint to retrieve the details of a draft rule.',
+                operationId: 'getDraft',
+            )
         ),
```

## Installation

Copy the content of `ApipMigrateOpenApiRector` in your project, and add it as a rules:

```php
<?php
// rector.php
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(App\ApipMigrateOpenApiRector::class);
    // ....
```

## Optional, beautiful output

>[!NOTE]
> Rector has no extension point to change the printer. And the default printer is final.
> So we need to hack a bit to change it. See this [locked issue](https://github.com/rectorphp/rector/issues/9033))

If you want a better output, you'll need to copy also the `MyBetterStandardPrinter` class in your project, and add it to the `rector.php`:

```php
<?php
// rector.php

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
```
