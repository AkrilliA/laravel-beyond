<?php

namespace Tests\Commands;

beforeEach(fn () => createFakeClass('Support\Controllers\Controller'));

test('can make controller', function () {
    $this->artisan('beyond:make:controller Admin/User/UserController');

    expect(base_path().'/src/App/Admin/User/Controllers/UserController.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make invokable controller', function () {
    $this->artisan('beyond:make:controller Admin/User/UserInvokableController --invokable');

    expect(base_path().'/src/App/Admin/User/Controllers/UserInvokableController.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->toFileContains('public function __invoke');
});
