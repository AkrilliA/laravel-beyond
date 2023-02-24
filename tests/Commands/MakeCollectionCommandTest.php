<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make collection', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    expect(base_path().'/modules/User/Domain/Collections/UserCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make plain collection', function () {
    $this->artisan('beyond:make:collection User/UserCollection --model=User');

    expect(base_path().'/modules/User/Domain/Collections/UserCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
