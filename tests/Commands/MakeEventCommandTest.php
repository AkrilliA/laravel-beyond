<?php

namespace Tests\Commands;

test('can make event', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    expect(base_path().'/src/Domain/User/Events/CreateUserEvent.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
