<?php

namespace Tests\Commands;

test('can make listener', function () {
    $this->artisan('beyond:make:listener User/CreateUserListener');

    expect(base_path() . '/src/Domain/User/Listeners/CreateUserListener.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:listener User/CreateUserListener');

    $file = base_path() . '/src/Domain/User/Listeners/CreateUserListener.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Listeners;');
});
