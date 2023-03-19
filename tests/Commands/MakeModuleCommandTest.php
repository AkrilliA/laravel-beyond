<?php

namespace Tests\Commands;

use Illuminate\Filesystem\Filesystem;

test('can make a module', function () {
    $this->artisan('beyond:make:module User');

    expect(base_path().'/modules/User/App/routes.php')
        ->toBeFile();

    expect(base_path().'/modules/User/Providers/UserServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/Providers/UserEventServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/Providers/UserRouteServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make a minimal module', function () {
    $this->artisan('beyond:make:module User --minimal');

    expect(base_path().'/modules/User/App/routes.php')
        ->toBeFile();

    expect(base_path().'/modules/User/Providers/UserServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/Providers/UserEventServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/Providers/UserRouteServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
