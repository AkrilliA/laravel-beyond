<?php

namespace Tests\Commands;

test('can make query', function () {
    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    expect(base_path() . '/src/App/Admin/User/Queries/IndexUserQuery.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    $file = base_path() . '/src/App/Admin/User/Queries/IndexUserQuery.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Queries;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    $file = base_path() . '/src/App/Admin/User/Queries/IndexUserQuery.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});