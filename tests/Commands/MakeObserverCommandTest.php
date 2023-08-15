<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeObserverCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeObserver(): void
    {
        $this->artisan('beyond:make:observer User.UserObserver');

        $file = beyond_modules_path('User/Domain/Observers/UserObserver.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeObserverUsingForce(): void
    {
        $this->artisan('beyond:make:observer User.UserObserver');

        $file = beyond_modules_path('User/Domain/Observers/UserObserver.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:observer User.UserObserver');

        $code->assertOk();
    }
}
