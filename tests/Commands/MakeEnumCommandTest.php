<?php

namespace Tests\Commands;

test('cannot make enum on php 8.0', function () {
    $this->artisan('beyond:make:enum')
        ->expectsOutputToContain(
            sprintf(
                'Your version id %s does not match the required version id 80100 of this command.',
                PHP_VERSION_ID
            )
        )
        ->assertExitCode(1);
})->skip(PHP_VERSION_ID >= 80100);

test('can make enum', function () {
    $this->artisan('beyond:make:enum User/UserStatusEnum');

    expect(base_path().'/src/Domain/User/Enums/UserStatusEnum.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
})->skip(PHP_VERSION_ID < 80100);
