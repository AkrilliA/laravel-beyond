<?php

namespace Tests;

class BaseTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeClassWithDirectory(): void
    {
        $this->artisan('beyond:make:action User.Admin/UserStoreAction');

        $file = beyond_modules_path('User/Domain/Actions/Admin/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeClassWithDeepDirectory(): void
    {
        $this->artisan('beyond:make:action User.Admin/SuperAdmin/UserStoreAction');

        $file = beyond_modules_path('User/Domain/Actions/Admin/SuperAdmin/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }
}
