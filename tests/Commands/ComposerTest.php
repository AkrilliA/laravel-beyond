<?php

namespace Tests\Commands;

use Regnerisch\LaravelBeyond\Composer;

test('test if package is installed', function () {
    $composer = Composer::getInstance();

    expect($composer->isPackageInstalled('pestphp/pest'))->toBeTrue();
});

test('test if package is not installed', function () {
    $composer = Composer::getInstance();

    expect($composer->isPackageInstalled('regnerisch/laravel-beyond'))->toBeFalse();
});
