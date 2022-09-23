<?php

namespace Tests\Commands;

use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make dto factory', function () {
    $this->artisan('beyond:make:dto-factory Admin/User/UserDataFactory');

    expect(base_path() . '/src/App/Admin/User/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make dto factory with dto', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/data-transfer-object']);

    $this->artisan('beyond:make:dto-factory Admin/User/UserDataFactory --dto=User/UserData');

    expect(base_path() . '/src/App/Admin/User/Factories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->and(base_path() . '/src/Domain/User/DataTransferObjects/UserData.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
