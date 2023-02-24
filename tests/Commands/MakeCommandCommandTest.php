<?php

namespace Tests\Commands;

beforeEach(fn () => $this->artisan('beyond:make:module User'));

test('can make command', function () {
    $this->artisan('beyond:make:command User/InspireCommand');

    expect(base_path().'/modules/User/App/Commands/InspireCommand.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});

test('can make command with command arg', function () {
    $this->artisan('beyond:make:command User/InspireCommand --command=user:inspire');

    expect(base_path().'/modules/User/App/Commands/InspireCommand.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
