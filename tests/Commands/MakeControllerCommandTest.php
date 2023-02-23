<?php

namespace Tests\Commands;

beforeEach(fn () => createFakeClass('App\\Http\\Controllers\\Controller'));

test('can make controller', function () {
    $this->artisan('beyond:make:controller User/UserController');

    expect(base_path().'/modules/User/App/Controllers/UserController.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make invokable controller', function () {
    $this->artisan('beyond:make:controller User/UserInvokableController --invokable');

    expect(base_path().'/modules/User/App/Controllers/UserInvokableController.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced()
        ->toFileContains('public function __invoke');
});
