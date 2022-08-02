<?php

namespace Tests\Commands;

test('can make policy', function () {
    $this->artisan('beyond:make:policy User/UserPolicy');

    expect(base_path() . '/src/Domain/User/Policies/UserPolicy.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:policy User/UserPolicy');

    $file = base_path() . '/src/Domain/User/Policies/UserPolicy.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Policies;');
});
