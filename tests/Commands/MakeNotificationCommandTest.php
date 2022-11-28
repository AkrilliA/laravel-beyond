<?php

namespace Tests\Commands;

test('can make notification', function () {
    $this->artisan('beyond:make:notification User/UserRegistered');

    expect(base_path().'/src/Domain/User/Notifications/UserRegistered.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make queueable notification', function () {
    $this->artisan('beyond:make:notification User/UserRegistered --queueable');

    expect(base_path().'/src/Domain/User/Notifications/UserRegistered.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->toFileContains('use Queueable');
});
