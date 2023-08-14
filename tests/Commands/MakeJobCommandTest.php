<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeJobCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('beyond:make:module User');
    }

    public function testCanMakeJob(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials');

        $file = beyond_modules_path('User/App/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;', $contents);
    }

    public function testCanMakeSyncedJob(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials --sync');

        $file = beyond_modules_path('User/App/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable;', $contents);
    }
}
