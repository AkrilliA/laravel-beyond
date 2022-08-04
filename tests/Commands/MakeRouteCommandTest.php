<?php

namespace Tests\Commands;

test('can make route', function () {
    $this->artisan('beyond:make:route Admin');

    expect(base_path() . '/routes/admin.php')
        ->toBeFile();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:route Admin');

    expect(base_path() . '/routes/admin.php')
        ->toPlaceholdersBeReplaced();
});
