<?php

namespace Tests\Commands;

test('can make request', function () {
    $this->artisan('beyond:make:request Admin/User/StoreUserRequest');

    expect(base_path() . '/src/App/Admin/User/Requests/StoreUserRequest.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:request Admin/User/StoreUserRequest');

    $file = base_path() . '/src/App/Admin/User/Requests/StoreUserRequest.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
