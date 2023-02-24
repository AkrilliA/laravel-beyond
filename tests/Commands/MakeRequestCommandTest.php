<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make request', function () {
    $this->artisan('beyond:make:request User/StoreUserRequest');

    expect(base_path().'/modules/User/App/Requests/StoreUserRequest.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
