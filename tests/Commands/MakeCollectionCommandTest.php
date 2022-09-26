<?php

namespace Tests\Commands;

test('can make collection', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    expect(base_path().'/src/Domain/User/Collections/UserCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
