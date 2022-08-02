<?php

namespace Tests\Commands;

test('can make collection', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    expect(base_path() . '/src/Domain/User/Collections/UserCollection.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:collection User/UserCollection');

    $file = base_path() . '/src/Domain/User/Collections/UserCollection.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\User\Collections;');
});
