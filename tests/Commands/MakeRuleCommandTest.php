<?php

namespace Tests\Commands;

test('can make rule', function () {
    $this->artisan('beyond:make:rule User/UserRule');

    expect(base_path().'/modules/User/App/Rules/UserRule.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
