<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:app User');
    }

    public function testCanMakeController(): void
    {
        $this->artisan('beyond:make:controller User.UserController');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeModuleController(): void
    {
        $this->artisan('beyond:make:controller User.User.UserController');

        $file = beyond_app_path('User/User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeControllerUsingForce(): void
    {
        $this->artisan('beyond:make:controller User.UserController');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:controller User.UserController');
        $code->assertOk();
    }

    public function testCanMakeApiController(): void
    {
        $this->artisan('beyond:make:controller User.UserController --api');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $methods = ['index()', 'show()', 'store()', 'update()', 'destroy()'];

        foreach ($methods as $method) {
            $this->assertStringContainsString($method, $contents);
        }
    }

    public function testCanMakeApiControllerUsingForce(): void
    {
        $this->artisan('beyond:make:controller User.UserController --api');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $methods = ['index()', 'show()', 'store()', 'update()', 'destroy()'];

        foreach ($methods as $method) {
            $this->assertStringContainsString($method, $contents);
        }

        $code = $this->artisan('beyond:make:controller User.UserController --api --force');

        $code->assertOk();
    }

    public function testCanMakeInvokableController(): void
    {
        $this->artisan('beyond:make:controller User.UserController --invokable');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);
    }

    public function testCanMakeInvokableControllerUsingForce(): void
    {
        $this->artisan('beyond:make:controller User.UserController --invokable');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);

        $code = $this->artisan('beyond:make:controller User.UserController --invokable --force');

        $code->assertOk();
    }
}
