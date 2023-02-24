<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make middleware', function () {
    $this->artisan('beyond:make:middleware User/PremiumUserMiddleware');

    expect(base_path().'/modules/User/App/Middleware/PremiumUserMiddleware.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
