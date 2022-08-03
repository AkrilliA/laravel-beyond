<?php

namespace Tests\Commands;

test('can make model', function () {
    $this->artisan('beyond:make:model User/User');

    expect(base_path() . '/src/Domain/User/Models/User.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:model User/User');

    $file = base_path() . '/src/Domain/User/Models/User.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
