<?php

namespace Tests\Commands;

test('can make enum', function () {
    $this->artisan('beyond:make:enum User/UserStatusEnum');

    expect(base_path() . '/src/Domain/User/Enums/UserStatusEnum.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:enum User/UserStatusEnum');

    $file = base_path() . '/src/Domain/User/Enums/UserStatusEnum.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Enums;');
});
