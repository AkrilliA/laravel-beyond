<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeResourceCommandTest extends TestCase
{
    public function testCanMakeResource(): void
    {
        $this->artisan('beyond:make:resource User.UserResource');

        $file = beyond_app_path('User/Resources/UserResource.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeResourceUsingForce(): void
    {
        $this->artisan('beyond:make:resource User.UserResource');

        $file = beyond_app_path('User/Resources/UserResource.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:resource User.UserResource --force');

        $code->assertOk();
    }
}
