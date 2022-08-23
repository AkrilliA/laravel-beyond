<?php

namespace Tests\Commands;

use Regnerisch\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make view model', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/laravel-view-models']);

    $this->artisan('beyond:make:vm Admin/User/UserViewModel');

    expect(base_path() . '/src/App/Admin/User/ViewModels/UserViewModel.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
