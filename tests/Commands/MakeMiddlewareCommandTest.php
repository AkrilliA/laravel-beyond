<?php

namespace Tests\Commands;

test('can make middleware', function () {
    $this->artisan('beyond:make:middleware Admin/User/PremiumUserMiddleware');

    expect(base_path() . '/src/App/Admin/User/Middleware/PremiumUserMiddleware.php')->toBeFile();
});

test('can make support middleware', function () {
    $this->artisan('beyond:make:middleware PremiumUserMiddleware --support');

    expect(base_path() . '/src/Support/Packages/Laravel/Middleware/PremiumUserMiddleware.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:middleware Admin/User/PremiumUserMiddleware');

    $file = base_path() . '/src/App/Admin/User/Middleware/PremiumUserMiddleware.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Middleware;');
});

test('support namespace is correct', function () {
    $this->artisan('beyond:make:middleware PremiumUserMiddleware --support');

    $file = base_path() . '/src/Support/Packages/Laravel/Middleware/PremiumUserMiddleware.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Support\Packages\Laravel\Middleware;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:middleware Admin/User/PremiumUserMiddleware');

    $file = base_path() . '/src/App/Admin/User/Middleware/PremiumUserMiddleware.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
