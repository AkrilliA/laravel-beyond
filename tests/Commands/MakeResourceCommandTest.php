<?php

namespace Tests\Commands;

test('can make resource', function () {
    $this->artisan('beyond:make:resource User/UserResource');

    expect(base_path().'/modules/User/App/Resources/UserResource.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make resource collection', function () {
    $this->artisan('beyond:make:resource User/UserResourceCollection');

    expect(base_path().'/modules/User/App/Resources/UserResourceCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
