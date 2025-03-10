<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeAdrActionCommandTest extends TestCase
{
    public function test_can_make_adr_action(): void
    {
        $this->artisan('beyond:make:adr-action User.StoreUserAction');

        $file = beyond_app_path('User/Actions/StoreUserAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);
    }

    public function test_can_make_adr_action_using_force(): void
    {
        $this->artisan('beyond:make:adr-action User.StoreUserAction');

        $file = beyond_app_path('User/Actions/StoreUserAction.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('__invoke()', $contents);

        $code = $this->artisan('beyond:make:adr-action User.StoreUserAction --force');

        $code->assertOk();
    }
}
