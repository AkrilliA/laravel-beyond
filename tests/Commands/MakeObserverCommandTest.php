<?php

namespace Tests\Commands;

test('can make observer', function () {
    $this->artisan('beyond:make:observer Users/UserObserver');

    expect(base_path().'/src/Domain/Users/Observers/UserObserver.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
