<?php

namespace Tests\Commands;

test('can make event', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    expect(base_path() . '/src/Domain/User/Events/CreateUserEvent.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:event User/CreateUserEvent');

    $file = base_path() . '/src/Domain/User/Events/CreateUserEvent.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Events;');
});
