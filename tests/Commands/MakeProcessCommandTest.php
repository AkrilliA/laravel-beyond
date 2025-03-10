<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeProcessCommandTest extends TestCase
{
    public function test_can_make_action(): void
    {
        $this->artisan('beyond:make:process User.AdminStoreUserProcess');

        $file = beyond_app_path('User/Processes/AdminStoreUserProcess.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_action_using_force(): void
    {
        $this->artisan('beyond:make:process User.AdminStoreUserProcess');

        $file = beyond_app_path('User/Processes/AdminStoreUserProcess.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:process User.AdminStoreUserProcess --force');

        $code->assertOk();
    }
}
