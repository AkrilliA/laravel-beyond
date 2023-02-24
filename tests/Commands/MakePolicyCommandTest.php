<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make policy', function () {
    $this->artisan('beyond:make:policy User/UserPolicy');

    expect(base_path().'/modules/User/Domain/Policies/UserPolicy.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
