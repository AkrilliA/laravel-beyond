<?php

namespace Tests\Commands;

test('can make middleware', function () {
    $this->artisan('beyond:make:middleware Admin/User/PremiumUserMiddleware');

    expect(base_path() . '/src/App/Admin/User/Middleware/PremiumUserMiddleware.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make support middleware', function () {
    $this->artisan('beyond:make:middleware PremiumUserMiddleware --support');

    expect(base_path() . '/src/Support/Packages/Laravel/Middleware/PremiumUserMiddleware.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
