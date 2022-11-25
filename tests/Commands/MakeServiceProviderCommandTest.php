<?php

namespace Tests\Commands;

test('can make service provider', function () {
    $this->artisan('beyond:make:provider UserServiceProvider');

    expect(base_path().'/src/App/Providers/UserServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
