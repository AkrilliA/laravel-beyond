<?php

namespace Tests\Commands;

test('can make rule', function () {
    $this->artisan('beyond:make:rule Admin/User/UserRule');

    expect(base_path() . '/src/App/Admin/User/Rules/UserRule.php')->toBeFile();
});

test('can make support rule', function () {
    $this->artisan('beyond:make:rule UserRule --support');

    expect(base_path() . '/src/Support/Packages/Laravel/Rules/UserRule.php')->toBeFile();
});
