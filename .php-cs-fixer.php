<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->notPath('Fixture')
;

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PHP83Migration' => true,
        '@PhpCsFixer' => true,
        '@Symfony' => true,
        '@Symfony:risky' => true,
        'php_unit_internal_class' => false, // From @PhpCsFixer but we don't want it
        'php_unit_test_class_requires_covers' => false, // From @PhpCsFixer but we don't want it
        'phpdoc_add_missing_param_annotation' => false, // From @PhpCsFixer but we don't want it
        'method_chaining_indentation' => false, // Do not work well with our ES Repository
        'concat_space' => ['spacing' => 'one'],
        'trailing_comma_in_multiline' => ['elements' => ['arrays', 'match', 'parameters']],
        'method_argument_space' => ['on_multiline' => 'ensure_fully_multiline'],
    ])
    ->setFinder($finder)
;
