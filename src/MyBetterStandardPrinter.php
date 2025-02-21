<?php

namespace App;

use Rector\PhpParser\Printer\BetterStandardPrinter;

class MyBetterStandardPrinter extends BetterStandardPrinter
{
    #[\Override]
    protected function pMaybeMultiline(array $nodes, bool $trailingComma = false): string
    {
        if ($this->onMultiline($nodes)) {
            return $this->pCommaSeparatedMultiline($nodes, true) . $this->nl;
        }
        if (!$this->hasNodeWithComments($nodes)) {
            return $this->pCommaSeparated($nodes);
        }

        return $this->pCommaSeparatedMultiline($nodes, $trailingComma) . $this->nl;
    }

    private function onMultiline(array $nodes): bool
    {
        foreach ($nodes as $node) {
            if ($node->getAttribute('multiline')) {
                return true;
            }
        }

        return false;
    }
}
