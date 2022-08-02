<?php

namespace Tests\Commands;

test('can make service provider', function () {
    $this->artisan('beyond:make:provider UserServiceProvider');

    expect(base_path() . '/src/App/Providers/UserServiceProvider.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:provider UserServiceProvider');

    $file = base_path() . '/src/App/Providers/UserServiceProvider.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Providers;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:provider UserServiceProvider');

    $file = base_path() . '/src/App/Providers/UserServiceProvider.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
