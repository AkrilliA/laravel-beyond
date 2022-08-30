<?php

namespace Tests\Commands;

use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make dto', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/data-transfer-object']);

    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path() . '/src/Domain/User/DataTransferObjects/UserData.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make dto with factory', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/data-transfer-object']);

    $this->artisan('beyond:make:dto User/UserData --factory')
        ->expectsQuestion('Please enter the app name', 'Web');

    expect(base_path() . '/src/App/Web/User/DataFactories/UserDataFactory.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
