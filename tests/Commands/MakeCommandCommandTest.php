<?php

namespace Tests\Commands;

test('can make command', function () {
    $this->artisan('beyond:make:command InspireCommand');

    expect(base_path().'/src/App/Console/Commands/InspireCommand.php')
        ->toBeFile()
        ->toMatchNamespaceAndClassName()
        ->toPlaceholdersBeReplaced();
});
