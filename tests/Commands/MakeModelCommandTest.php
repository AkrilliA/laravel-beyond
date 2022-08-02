<?php

namespace Tests\Commands;

test('can make model', function () {
    $this->artisan('beyond:make:model User/User');

    expect(base_path() . '/src/Domain/User/Models/User.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:model User/User');

    $file = base_path() . '/src/Domain/User/Models/User.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Models;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:model User/User');

    $file = base_path() . '/src/Domain/User/Models/User.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});