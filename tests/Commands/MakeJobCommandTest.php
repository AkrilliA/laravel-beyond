<?php

namespace Tests\Commands;

test('can make job', function () {
    $this->artisan('beyond:make:job Admin/User/UserJob');

    expect(base_path() . '/src/App/Admin/User/Jobs/UserJob.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:job Admin/User/UserJob');

    $file = base_path() . '/src/App/Admin/User/Jobs/UserJob.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Jobs;');
});

test('placeholder are replaced', function () {
    $this->artisan('beyond:make:job Admin/User/UserJob');

    $file = base_path() . '/src/App/Admin/User/Jobs/UserJob.php';
    $content = file_get_contents($file);

    expect($content)->not()->toMatch('/{{ .* }}/');
});
