<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make builder', function () {
    $this->artisan('beyond:make:builder User/UserBuilder');

    expect(base_path().'/modules/User/Domain/Builders/UserBuilder.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
