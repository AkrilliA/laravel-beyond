<?php

namespace Tests\Commands;

test('can make route', function () {
    $this->artisan('beyond:make:route Admin');

    expect(base_path() . '/routes/admin.php')
        ->toBeFile();
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:route Admin');

    $file = base_path() . '/routes/admin.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
