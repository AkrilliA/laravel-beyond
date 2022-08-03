<?php

namespace Tests\Commands;

test('can make builder', function () {
    $this->artisan('beyond:make:builder User/UserBuilder');

    expect(base_path() . '/src/Domain/User/Builders/UserBuilder.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:builder User/UserBuilder');

    $file = base_path() . '/src/Domain/User/Builders/UserBuilder.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
