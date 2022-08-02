<?php

namespace Tests\Commands;

test('can make command', function () {
    $this->artisan('beyond:make:command InspireCommand');

    expect(base_path() . '/src/App/Console/Commands/InspireCommand.php')->toBeFile();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:command InspireCommand');

    $file = base_path() . '/src/App/Console/Commands/InspireCommand.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace App\Console\Commands;');
});
