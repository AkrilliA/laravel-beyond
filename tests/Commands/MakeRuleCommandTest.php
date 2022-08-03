<?php

namespace Tests\Commands;

test('can make rule', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    expect(base_path() . '/src/App/Admin/User/Rules/UserRule.php')->toBeFile();
});

test('can make support rule', function () {
    $this->artisan('beyond:make:rule UserRule --support');

    expect(base_path() . '/src/Support/Packages/Laravel/Rules/UserRule.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    $file = base_path() . '/src/App/Admin/User/Rules/UserRule.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Rules;');
});

test('support namespace is correct', function () {
    $this->artisan('beyond:make:rule UserRule --support');

    $file = base_path() . '/src/Support/Packages/Laravel/Rules/UserRule.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Support\Packages\Laravel\Rules;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    $file = base_path() . '/src/App/Admin/User/Rules/UserRule.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
