<?php

namespace Tests\Commands;

test('can make resource', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResource');

    expect(base_path() . '/src/App/Admin/User/Resources/UserResource.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('can make resource collection', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResourceCollection');

    expect(base_path() . '/src/App/Admin/User/Resources/UserResourceCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResource');

    $file = base_path() . '/src/App/Admin/User/Resources/UserResource.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});

test('collection placeholder are replaced', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResourceCollection');

    $file = base_path() . '/src/App/Admin/User/Resources/UserResourceCollection.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
