<?php

namespace Tests\Commands;

test('can make trait', function () {
    $this->artisan('beyond:make:trait HasActivationCodeTrait');

    expect(base_path().'/src/Support/Traits/HasActivationCodeTrait.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->toFileContains('trait HasActivationCodeTrait');
});
