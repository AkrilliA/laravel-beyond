<?php

namespace Tests\Commands;

test('can make middleware', function () {
    $this->artisan('beyond:make:middleware User/PremiumUserMiddleware');

    expect(base_path().'/modules/User/App/Middlewares/PremiumUserMiddleware.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
