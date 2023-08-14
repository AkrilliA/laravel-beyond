<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeCommandCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeCommand(): void
    {
        $this->artisan('beyond:make:command User.CreateUser');

        $file = beyond_modules_path('User/App/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeCommandWithPredefinedSignature(): void
    {
        $this->artisan('beyond:make:command User.CreateUser --command=test:execute');

        $file = beyond_modules_path('User/App/Commands/CreateUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('test:execute', $contents);
    }
}
