<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeJobCommandTest extends TestCase
{
    public function test_can_make_job(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials');

        $file = beyond_app_path('User/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;', $contents);
    }

    public function test_can_make_job_using_force(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials');

        $file = beyond_app_path('User/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;', $contents);

        $code = $this->artisan('beyond:make:job User.CancelTrials --force');

        $code->assertOk();
    }

    public function test_can_make_synced_job(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials --sync');

        $file = beyond_app_path('User/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable;', $contents);
    }

    public function test_can_make_synced_job_using_force(): void
    {
        $this->artisan('beyond:make:job User.CancelTrials --sync');

        $file = beyond_app_path('User/Jobs/CancelTrials.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
        $this->assertStringContainsString('use Dispatchable;', $contents);

        $code = $this->artisan('beyond:make:job User.CancelTrials --sync --force');

        $code->assertOk();
    }
}
