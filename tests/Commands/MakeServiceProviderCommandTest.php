<?php

namespace Tests\Commands;

test('can make service provider', function () {
    $this->artisan('beyond:make:provider User/UserServiceProvider');

    expect(base_path().'/modules/User/Providers/UserServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
})->skip('TODO');
