<?php

namespace Tests\Commands;

test('can make query', function () {
    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    expect(base_path() . '/src/App/Admin/User/Queries/IndexUserQuery.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    expect(base_path() . '/src/App/Admin/User/Queries/IndexUserQuery.php')
        ->toPlaceholdersBeReplaced();
});
