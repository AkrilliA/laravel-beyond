<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeDataTransferObjectCommandTest extends TestCase
{
    public function testCanMakeDataTransferObject(): void
    {
        $this->artisan('beyond:make:data User.UserData');

        $file = beyond_domain_path('User/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeDataTransferObjectUsingForce(): void
    {
        $this->artisan('beyond:make:data User.UserData');

        $file = beyond_domain_path('User/DataObjects/UserData.php');
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

        $file = beyond_domain_path('User/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeDataTransferWithAliasObjectUsingForce(): void
    {
        $this->artisan('beyond:make:dto User.UserData');

        $file = beyond_domain_path('User/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:dto User.UserData --force');

        $code->assertOk();
    }
}
