<?php

namespace Tests\Commands;

test('can make controller', function () {
    $this->artisan('beyond:make:controller Admin/User/UserController');

    expect(base_path() . '/src/App/Admin/User/Controllers/UserController.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:controller Admin/User/UserController');

    $file = base_path() . '/src/App/Admin/User/Controllers/UserController.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
