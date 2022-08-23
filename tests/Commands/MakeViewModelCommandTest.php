<?php

namespace Tests\Commands;

test('can make view model', function () {
    $this->artisan('beyond:make:vm Admin/User/UserViewModel');

    expect(base_path() . '/src/App/Admin/User/ViewModels/UserViewModel.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
