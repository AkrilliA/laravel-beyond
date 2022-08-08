<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ]);

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony' => true,
    'concat_space' => [
        'spacing' => 'one'
    ],
    'multiline_whitespace_before_semicolons' => [
        'strategy' => 'no_multi_line'
    ]
])->setFinder($finder);
