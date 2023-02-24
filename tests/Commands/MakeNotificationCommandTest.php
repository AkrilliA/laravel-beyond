<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make notification', function () {
    $this->artisan('beyond:make:notification User/UserRegistered');

    expect(base_path().'/modules/User/Domain/Notifications/UserRegistered.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
