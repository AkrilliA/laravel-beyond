<?php

namespace Tests\Commands;

test('can make command', function () {
    $this->artisan('beyond:make:command User/InspireCommand');

    expect(base_path().'/modules/User/App/Commands/InspireCommand.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
