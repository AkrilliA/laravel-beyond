<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeDataTransferObjectCommandTest extends TestCase
{
    public function test_can_make_data_transfer_object(): void
    {
        $this->artisan('beyond:make:data User.UserData');

        $file = beyond_domain_path('User/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_data_transfer_object_using_force(): void
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

    public function test_can_make_data_transfer_with_alias_object(): void
    {
        $this->artisan('beyond:make:dto User.UserData');

        $file = beyond_domain_path('User/DataObjects/UserData.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_data_transfer_with_alias_object_using_force(): void
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
