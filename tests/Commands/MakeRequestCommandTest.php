<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeRequestCommandTest extends TestCase
{
    public function test_can_make_request(): void
    {
        $this->artisan('beyond:make:request User.StoreUserRequest');

        $file = beyond_app_path('User/Requests/StoreUserRequest.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_request_using_force(): void
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
