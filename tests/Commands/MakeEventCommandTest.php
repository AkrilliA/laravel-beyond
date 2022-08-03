<?php

namespace Tests\Commands;

test('can make event', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    expect(base_path() . '/src/Domain/User/Events/CreateUserEvent.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    $file = base_path() . '/src/Domain/User/Events/CreateUserEvent.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
