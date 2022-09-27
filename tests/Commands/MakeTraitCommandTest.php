<?php

namespace Tests\Commands;

test('can make trait', function () {
    $this->artisan('beyond:make:trait Users/HasActivationCodeTrait');

    expect(base_path() . '/src/Domain/Users/Traits/HasActivationCodeTrait.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});

test('can make support trait', function () {
    $this->artisan('beyond:make:trait HasActivationCodeTrait --support');

    expect(base_path() . '/src/Support/Packages/Laravel/Traits/HasActivationCodeTrait.php')
        ->toBeFile()
        ->toPlaceholdersBeReplaced();
});

test('namespace is correct', function () {
    $this->artisan('beyond:make:trait Users/HasActivationCodeTrait');

    $file = base_path() . '/src/Domain/Users/Traits/HasActivationCodeTrait.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Domain\Users\Traits;');
});

test('support namespace is correct', function () {
    $this->artisan('beyond:make:trait HasActivationCodeTrait --support');

    $file = base_path() . '/src/Support/Packages/Laravel/Traits/HasActivationCodeTrait.php';
    $content = file_get_contents($file);
    expect($content)->toContain('namespace Support\Packages\Laravel\Traits;');
});

test('starts with trait', function () {
    $this->artisan('beyond:make:trait Users/HasActivationCodeTrait');

    $file = base_path() . '/src/Domain/Users/Traits/HasActivationCodeTrait.php';
    $content = file_get_contents($file);
    expect($content)->toContain('trait HasActivationCodeTrait');
});

test('support starts with trait', function () {
    $this->artisan('beyond:make:trait HasActivationCodeTrait --support');

    $file = base_path() . '/src/Support/Packages/Laravel/Traits/HasActivationCodeTrait.php';
    $content = file_get_contents($file);
    expect($content)->toContain('trait HasActivationCodeTrait');
});
