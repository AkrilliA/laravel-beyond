<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make service provider', function () {
    $this->artisan('beyond:make:provider User/UserAdditionalServiceProvider');

    expect(base_path().'/modules/User/UserAdditionalServiceProvider.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
