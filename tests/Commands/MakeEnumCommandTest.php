<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeEnumCommandTest extends TestCase
{
    public function testCanMakeEnum(): void
    {
        $this->artisan('beyond:make:enum User.UserType');

        $file = beyond_domain_path('User/Enums/UserType.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeEnumUsingForce(): void
    {
        $this->artisan('beyond:make:enum User.UserType');

        $file = beyond_domain_path('User/Enums/UserType.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:enum User.UserType --force');

        $code->assertOk();
    }
}
