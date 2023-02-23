<?php

namespace Tests\Commands;

test('can make dto factory', function () {
    $this->artisan('beyond:make:dto-factory User/UserDataFactory');

    expect(base_path().'/modules/User/App/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
})->skip('TODO');

test('can make dto factory with dto', function () {
    $this->artisan('beyond:make:dto-factory User/UserDataFactory --dto=User/UserData');

    expect(base_path().'/modules/User/App/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
})->skip('TODO');
