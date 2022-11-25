<?php

namespace Tests\Commands;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make action', function () {
    $this->artisan('beyond:make:action User/CreateUserAction');

    expect(base_path().'/src/Domain/User/Actions/CreateUserAction.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make action queueable', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/laravel-queueable-action']);

    $this->artisan('beyond:make:action User/CreateUserQueueableAction --queueable');

    expect(base_path().'/src/Domain/User/Actions/CreateUserQueueableAction.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
