<?php

declare(strict_types=1);

namespace App\Tests\ApipMigrateOpenApiRector;

use PhpParser\NodeAbstract;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;
use Symfony\Component\VarDumper\Caster\Caster;
use Symfony\Component\VarDumper\Caster\CutStub;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

final class ApipMigrateOpenApiRectorTest extends AbstractRectorTestCase
{
    public static function setUpBeforeClass(): void
    {
        AbstractCloner::$defaultCasters += [
            NodeAbstract::class => function (NodeAbstract $node, array $a) {
                $key = Caster::PREFIX_PROTECTED . 'attributes';
                if (\array_key_exists($key, $a)) {
                    $a[$key]['scope'] = new CutStub($a[$key]['scope']);
                }
                if (\array_key_exists($key, $a)) {
                    $a[$key]['origNode'] = new CutStub($a[$key]['origNode']);
                }
                // Bourin mode!
                $a[$key] = new CutStub($a[$key]);

                return $a;
            },
        ];
    }

    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): \Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}
