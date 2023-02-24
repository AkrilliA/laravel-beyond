<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make listener', function () {
    $this->artisan('beyond:make:listener User/CreateUserListener');

    expect(base_path().'/modules/User/Domain/Listeners/CreateUserListener.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
