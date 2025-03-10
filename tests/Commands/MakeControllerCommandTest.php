<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeControllerCommandTest extends TestCase
{
    public function test_can_make_controller(): void
    {
        $this->artisan('beyond:make:controller User.UserController');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_controller_using_force(): void
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

    public function test_can_make_api_controller(): void
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

    public function test_can_make_api_controller_using_force(): void
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

    public function test_can_make_invokable_controller(): void
    {
        $this->artisan('beyond:make:controller User.UserController --invokable');

        $file = beyond_app_path('User/Controllers/UserController.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);
    }

    public function test_can_make_invokable_controller_using_force(): void
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
