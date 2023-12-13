<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeRequestCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:app User');
    }

    public function testCanMakeRequest(): void
    {
        $this->artisan('beyond:make:request User.StoreUserRequest');

        $file = beyond_app_path('User/Requests/StoreUserRequest.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeRequestUsingForce(): void
    {
        $this->artisan('beyond:make:request User.StoreUserRequest');

        $file = beyond_app_path('User/Requests/StoreUserRequest.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:request User.StoreUserRequest --force');

        $code->assertOk();
    }
}
