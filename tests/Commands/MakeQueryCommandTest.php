<?php

namespace Tests\Commands;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make query', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/laravel-query-builder']);

    $this->artisan('beyond:make:query Admin/User/IndexUserQuery');

    expect(base_path().'/src/App/Admin/User/Queries/IndexUserQuery.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
