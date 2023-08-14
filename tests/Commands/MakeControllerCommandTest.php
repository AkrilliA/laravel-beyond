<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeController(): void
    {
        $this->artisan('beyond:make:controller User.UserController');

        $file = beyond_modules_path('User/App/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeApiController(): void
    {
        $this->artisan('beyond:make:controller User.UserController --api');

        $file = beyond_modules_path('User/App/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $methods = ['index()', 'show()', 'store()', 'update()', 'destroy()'];

        foreach ($methods as $method) {
            $this->assertStringContainsString($method, $contents);
        }
    }

    public function testCanMakeInvokableController(): void
    {
        $this->artisan('beyond:make:controller User.UserController --invokable');

        $file = beyond_modules_path('User/App/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);
    }
}
