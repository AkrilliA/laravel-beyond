<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make observer', function () {
    $this->artisan('beyond:make:observer User/UserObserver');

    expect(base_path().'/modules/User/Domain/Observers/UserObserver.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
