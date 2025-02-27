<?php

namespace App;

use ApiPlatform\Metadata\HttpOperation;
use ApiPlatform\OpenApi\Model\Operation;
use PhpParser\Node;
use PhpParser\Node\Arg;
use PhpParser\Node\Attribute;
use PhpParser\Node\Expr\New_;
use Rector\PhpParser\Node\Value\ValueResolver;
use Rector\Rector\AbstractRector;

final class ApipMigrateOpenApiRector extends AbstractRector
{
    public function __construct(
        private readonly ValueResolver $valueResolver,
    ) {
    }

    public function getNodeTypes(): array
    {
        return [New_::class, Attribute::class];
    }

    public function refactor(Node $node)
    {
        if ($node instanceof New_ && is_a($this->getName($node->class), HttpOperation::class, true)) {
            return $this->convert($node);
        }

        return null;
    }

    private function convert(Node $node): ?Node
    {
        $openApiArgs = [];
        $toDelete = [];
        $changed = false;

        foreach ($node->args as $k => $arg) {
            if ('openapiContext' === $this->getName($arg)) {
                $changed = true;
                $toDelete[] = $k;

                $argValue = $arg->value;

                if (!$argValue instanceof Node\Expr\Array_) {
                    // It should be an array! If it's not, we can't do anything.
                    continue;
                }

                foreach ($argValue->items as $item) {
                    $openApiArgs[] = new Node\Arg(
                        $item->value,
                        name: new Node\Identifier($this->valueResolver->getValue($item->key)),
                        attributes: [
                            ...$item->getAttributes(),
                            'multiline' => true,
                        ],
                    );
                }

                continue;
            }

            if ('openapi' === $this->getName($arg)) {
                $toDelete[] = $k;

                foreach ($arg->value->args ?? [] as $item) {
                    $openApiArgs[] = new Node\Arg(
                        $item->value,
                        name: $item->name,
                        attributes: [
                            ...$item->getAttributes(),
                            'multiline' => true,
                        ],
                    );
                }

                continue;
            }
        }

        if (!$openApiArgs || !$changed) {
            return null;
        }

        foreach ($toDelete as $k) {
            unset($node->args[$k]);
        }

        $openApi = new Arg(
            new New_(
                new Node\Name\FullyQualified(Operation::class),
                $openApiArgs,
            ),
            name: new Node\Identifier('openapi'),
        );
        $node->args[] = $openApi;


        return $node;
    }
}
