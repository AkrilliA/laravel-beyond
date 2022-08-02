<?php

namespace Tests\Commands;

test('can make controller', function () {
    $this->artisan('beyond:make:controller Admin/User/UserController');

    expect(base_path() . '/src/App/Admin/User/Controllers/UserController.php')->toBeFile();
});
