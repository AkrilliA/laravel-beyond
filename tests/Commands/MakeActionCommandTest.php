<?php

namespace Tests\Commands;

test('can make action', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    expect(base_path() . '/src/Domain/User/Actions/CreateUserAction.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    $file = base_path() . '/src/Domain/User/Actions/CreateUserAction.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
