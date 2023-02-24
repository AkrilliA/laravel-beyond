<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make rule', function () {
    $this->artisan('beyond:make:rule User/UserRule');

    expect(base_path().'/modules/User/App/Rules/UserRule.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
