<?php

namespace Tests\Commands;

test('can make resource', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResource');

    expect(base_path() . '/src/App/Admin/User/Resources/UserResource.php')->toBeFile();
});

test('can make resource collection', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResourceCollection');

    expect(base_path() . '/src/App/Admin/User/Resources/UserResourceCollection.php')->toBeFile();
});

test('resource namespace is correct', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResource');

    $file = base_path() . '/src/App/Admin/User/Resources/UserResource.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Resources;');
});

test('collection namespace is correct', function () {
    $this->artisan('beyond:make:resource Admin/User/UserResourceCollection');

    $file = base_path() . '/src/App/Admin/User/Resources/UserResourceCollection.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Resources;');
});
