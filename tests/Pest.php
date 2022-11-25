<?php

use Illuminate\Filesystem\Filesystem;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(Tests\TestCase::class)->in(__DIR__);

uses()
    ->afterEach(function () {
        (new Filesystem())->deleteDirectories(base_path().'/src');
    })
    ->in(__DIR__.'/Commands');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toMatchNamespaceAndClassName', function () {
    spl_autoload_register(function ($className) {
        $path = base_path().'/src/'.str_replace('\\', '/', $className).'.php';
        $fs = new Filesystem();
        if ($fs->exists($path)) {
            require_once $path;
        }
    });

    $namespacedClassName = str_replace(
        '/',
        '\\',
        substr($this->value, strpos($this->value, 'src') + 4, -4)
    );

    $class = new class()
    {
        public function getName()
        {
            return null;
        }
    };

    try {
        $class = new ReflectionClass($namespacedClassName);
    } catch (\ReflectionException $exception) {
        // --
    }

    return $this
        ->and($class->getName())
        ->toBe($namespacedClassName)
        ->and($this->value);
});

expect()->extend('toPlaceholdersBeReplaced', function () {
    $content = (new Filesystem())->get($this->value);

    return $this
        ->and($content)
        ->not()
        ->toMatch('/{{ .* }}/')
        ->and($this->value);
});

expect()->extend('toFileContains', function ($string) {
    $content = (new Filesystem())->get($this->value);

    return $this
        ->and($content)
        ->toContain($string)
        ->and($this->value);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/
function createFakeClass(string $fqn): void
{
    $fs = new Filesystem();

    $parts = explode('\\', $fqn);
    $className = array_pop($parts);

    $path = base_path().'/src/'.implode('/', $parts);

    $fs->ensureDirectoryExists($path);
    $fs->put($path.'/'.$className.'.php', '<?php namespace '.implode('\\', $parts)."; class {$className} {}");
}
