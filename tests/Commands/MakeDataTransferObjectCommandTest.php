<?php

namespace Tests\Commands;

use AkrilliA\LaravelBeyond\Contracts\Composer as ComposerContract;

test('can make dto', function () {
    $composer = $this->app->make(ComposerContract::class);

    $composer->setPackages(['spatie/data-transfer-object']);

    $this->artisan('beyond:make:dto User/UserData');

    expect(base_path().'/src/Domain/User/DataTransferObjects/UserData.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
