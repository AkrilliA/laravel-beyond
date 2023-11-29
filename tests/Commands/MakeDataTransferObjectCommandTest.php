<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeDataTransferObjectCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeDataTransferObject(): void
    {
        $this->artisan('beyond:make:data User.UserData');

        $file = beyond_modules_path('User/Domain/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeDataTransferObjectUsingForce(): void
    {
        $this->artisan('beyond:make:data User.UserData');

        $file = beyond_modules_path('User/Domain/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:data User.UserData --force');

        $code->assertOk();
    }

    public function testCanMakeDataTransferWithAliasObject(): void
    {
        $this->artisan('beyond:make:dto User.UserData');

        $file = beyond_modules_path('User/Domain/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeDataTransferWithAliasObjectUsingForce(): void
    {
        $this->artisan('beyond:make:dto User.UserData');

        $file = beyond_modules_path('User/Domain/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:dto User.UserData --force');

        $code->assertOk();
    }
}
