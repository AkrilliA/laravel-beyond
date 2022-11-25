<?php

namespace Tests\Commands;

test('can make rule', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    expect(base_path().'/src/App/Admin/User/Rules/UserRule.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});

test('can make support rule', function () {
    $this->artisan('beyond:make:rule UserRule --support');

    expect(base_path().'/src/Support/Rules/UserRule.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    $file = base_path().'/src/App/Admin/User/Rules/UserRule.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Admin\User\Rules;');
});

test('support namespace is correct', function () {
    $this->artisan('beyond:make:rule UserRule --support');

    $file = base_path().'/src/Support/Rules/UserRule.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Support\Rules;');
});
