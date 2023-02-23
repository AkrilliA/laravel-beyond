<?php

namespace Tests\Commands;

test('can make notification', function () {
    $this->artisan('beyond:make:notification User/UserRegistered');

    expect(base_path().'/modules/User/Domain/Notifications/UserRegistered.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
