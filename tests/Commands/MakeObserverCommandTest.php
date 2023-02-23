<?php

namespace Tests\Commands;

test('can make observer', function () {
    $this->artisan('beyond:make:observer User/UserObserver');

    expect(base_path().'/modules/User/Domain/Observers/UserObserver.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
