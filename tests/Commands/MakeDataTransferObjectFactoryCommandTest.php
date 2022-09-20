<?php

namespace Tests\Commands;

test('can make dto factory', function () {
    $this->artisan('beyond:make:dto-factory Admin/User/UserDataFactory');

    expect(base_path() . '/src/App/Admin/User/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make dto factory with dto', function () {
    $this->artisan('beyond:make:dto-factory Admin/User/UserDataFactory --dto=Domain/User/DataTransferObjects/UserData');

    expect(base_path() . '/src/App/Admin/User/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
