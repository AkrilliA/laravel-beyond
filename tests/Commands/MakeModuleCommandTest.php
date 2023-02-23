<?php

namespace Tests\Commands;

use Illuminate\Filesystem\Filesystem;

test('can make a module', function () {
    $this->artisan('beyond:make:module User --force');

    expect(base_path().'/modules/User/UserServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/UserEventServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/UserRouteServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect((new Filesystem())->directories(base_path().'/modules/User'))
        ->toContain(
            base_path().'/modules/User/App',
            base_path().'/modules/User/Domain',
            base_path().'/modules/User/Infrastructure',
        );
});
