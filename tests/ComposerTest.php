<?php

namespace Tests\Commands;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;
use AkrilliA\LaravelBeyond\Testing\Fakes\ComposerFake;

test('test if fake composer is used', function () {
    $composer = $this->app->make(ComposerContract::class);

    expect($composer)
        ->toBeInstanceOf(ComposerFake::class);
});

test('test if required package is installed', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['test/test']);

    expect($composer->isPackageInstalled('test/test'))
        ->toBeTrue();
});

test('test if required-dev package is installed', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(requireDev: ['test/test']);

    expect($composer->isPackageInstalled('test/test', true))
        ->toBeTrue();
});
