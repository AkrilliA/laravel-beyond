<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make query', function () {
    $this->artisan('beyond:make:query User/IndexUserQuery');

    expect(base_path().'/modules/User/App/Queries/IndexUserQuery.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make query and model', function () {
    $this->artisan('beyond:make:query User/IndexUserQuery --model=User');

    expect(base_path().'/modules/User/App/Queries/IndexUserQuery.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();

    expect(base_path().'/modules/User/Domain/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
