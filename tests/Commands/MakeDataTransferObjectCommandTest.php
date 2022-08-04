<?php

namespace Tests\Commands;

test('can make dto', function () {
    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path() . '/src/Domain/User/DataTransferObjects/UserData.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path() . '/src/Domain/User/DataTransferObjects/UserData.php')
        ->toPlaceholdersBeReplaced();
});