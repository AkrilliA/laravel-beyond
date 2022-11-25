<?php

namespace Tests\Commands;

test('can make policy', function () {
    $this->artisan('beyond:make:policy User/UserPolicy');

    expect(base_path().'/src/Domain/User/Policies/UserPolicy.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
