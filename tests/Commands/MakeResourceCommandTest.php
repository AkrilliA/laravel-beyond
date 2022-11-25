<?php

namespace Tests\Commands;

test('can make resource', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResource');

    expect(base_path().'/src/App/Admin/User/Resources/UserResource.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make resource collection', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResourceCollection');

    expect(base_path().'/src/App/Admin/User/Resources/UserResourceCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
