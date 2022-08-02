<?php

namespace Tests\Commands;

test('can make dto', function () {
    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path() . '/src/Domain/User/DataTransferObjects/UserData.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:dto User/UserData');

    $file = base_path() . '/src/Domain/User/DataTransferObjects/UserData.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\DataTransferObjects;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:dto User/UserData');

    $file = base_path() . '/src/Domain/User/DataTransferObjects/UserData.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
