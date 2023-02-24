<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make event', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    expect(base_path().'/modules/User/Domain/Events/CreateUserEvent.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
