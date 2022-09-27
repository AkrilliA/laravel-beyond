<?php

namespace Tests\Commands;

test('can make trait', function () {
    $this->artisan('beyond:make:trait Users/HasActivationCodeTrait');

    expect(base_path() . '/src/Domain/Users/Traits/HasActivationCodeTrait.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->toFileContains('trait HasActivationCodeTrait');
});

test('can make support trait', function () {
    $this->artisan('beyond:make:trait HasActivationCodeTrait --support');

    expect(base_path() . '/src/Support/Traits/HasActivationCodeTrait.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced()
        ->toMatchNamespaceAndClassName()
        ->toFileContains('trait HasActivationCodeTrait');
});
