<?php

namespace Tests\Commands;

test('can make action', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    expect(base_path() . '/src/Domain/User/Actions/CreateUserAction.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    $file = base_path() . '/src/Domain/User/Actions/CreateUserAction.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Actions;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    $file = base_path() . '/src/Domain/User/Actions/CreateUserAction.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});