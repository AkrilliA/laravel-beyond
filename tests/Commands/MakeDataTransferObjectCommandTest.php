<?php

namespace Tests\Commands;

test('can make dto', function () {
    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path().'/modules/User/Domain/DataTransferObjects/UserData.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
