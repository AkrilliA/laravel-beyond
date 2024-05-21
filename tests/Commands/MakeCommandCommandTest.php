<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeCommandCommandTest extends TestCase
{
    public function testCanMakeCommand(): void
    {
        $this->artisan('beyond:make:command User.CreateUser');

        $file = beyond_app_path('User/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeCommandUsingForce(): void
    {
        $this->artisan('beyond:make:command User.CreateUser');

        $file = beyond_app_path('User/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:command User.CreateUser --force');
        $code->assertOk();
    }

    public function testCanMakeCommandWithPredefinedSignature(): void
    {
        $this->artisan('beyond:make:command User.CreateUser --command=test:execute');

        $file = beyond_app_path('User/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('test:execute', $contents);
    }

    public function testCanMakeCommandWithPredefinedSignatureUsingForce(): void
    {
        $this->artisan('beyond:make:command User.CreateUser --command=test:execute');

        $file = beyond_app_path('User/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('test:execute', $contents);

        $code = $this->artisan('beyond:make:command User.CreateUser --command=test:execute --force');
        $code->assertOk();
    }
}
