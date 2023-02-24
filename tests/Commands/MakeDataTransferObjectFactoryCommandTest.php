<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make dto factory', function () {
    $this->artisan('beyond:make:dto-factory User/UserDataFactory');

    expect(base_path().'/modules/User/App/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make dto factory with dto', function () {
    $this->artisan('beyond:make:dto-factory User/UserDataFactory --dto=UserData');

    expect(base_path().'/modules/User/App/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
