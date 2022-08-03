<?php

namespace Tests\Commands;

test('can make collection', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    expect(base_path() . '/src/Domain/User/Collections/UserCollection.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    $file = base_path() . '/src/Domain/User/Collections/UserCollection.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
