<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeActionCommandTest extends TestCase
{
    public function test_can_make_action(): void
    {
        $this->artisan('beyond:make:action User.UserStoreAction');

        $file = beyond_domain_path('User/Actions/UserStoreAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_action_using_force(): void
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
