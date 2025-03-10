<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeObserverCommandTest extends TestCase
{
    public function test_can_make_observer(): void
    {
        $this->artisan('beyond:make:observer User.UserObserver');

        $file = beyond_domain_path('User/Observers/UserObserver.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function test_can_make_observer_using_force(): void
    {
        $this->artisan('beyond:make:observer User.UserObserver');

        $file = beyond_domain_path('User/Observers/UserObserver.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:observer User.UserObserver');

        $code->assertOk();
    }
}
