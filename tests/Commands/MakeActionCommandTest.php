<?php

namespace Tests\Commands;

test('can make action', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    expect(base_path().'/modules/User/Domain/Actions/CreateUserAction.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
