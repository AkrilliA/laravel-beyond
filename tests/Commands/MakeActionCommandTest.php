<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeActionCommandTest extends TestCase
{
    public function testCanMakeAction(): void
    {
        $this->artisan('beyond:make:action User.UserStoreAction');

        $file = beyond_domain_path('User/Actions/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeActionUsingForce(): void
    {
        $this->artisan('beyond:make:action User.UserStoreAction');

        $file = beyond_domain_path('User/Actions/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:action User.UserStoreAction --force');

        $code->assertOk();
    }
}
