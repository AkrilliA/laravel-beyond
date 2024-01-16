<?php

namespace Tests\Commands;

use Illuminate\Support\Str;
use Tests\TestCase;

class MakeAppCommandTest extends TestCase
{
    public function testCanMakeModule(): void
    {
        $this->artisan('beyond:make:app Admin');

        $file = beyond_app_path('Admin/Providers/AdminServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }

    public function testCanMakeSnakeCaseModule(): void
    {
        $this->artisan('beyond:make:app SuperAdmin');

        $file = beyond_app_path('SuperAdmin/Providers/SuperAdminServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }

    public function testCanMakeModuleUsingForce(): void
    {
        $this->artisan('beyond:make:app Admin');

        $file = beyond_app_path('Admin/Providers/AdminServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);

        $code = $this->artisan('beyond:make:app Admin --force');

        $code->assertOk();
    }

    //    public function testCanMakeFullModule(): void
    //    {
    //        $this->artisan('beyond:make:app Admin --full');
    //
    //        $files = $this->getPaths();
    //
    //        foreach ($files as $file) {
    //            match (Str::contains($file, '.')) {
    //                true  => $this->assertFileExists($file),
    //                false => $this->assertDirectoryExists($file),
    //            };
    //        }
    //    }

    //    public function testCanMakeFullModuleUsingForce(): void
    //    {
    //        $this->artisan('beyond:make:module User --full');
    //
    //        $files = $this->getPaths();
    //
    //        foreach ($files as $file) {
    //            match (Str::contains($file, '.')) {
    //                true  => $this->assertFileExists($file),
    //                false => $this->assertDirectoryExists($file),
    //            };
    //        }
    //
    //        $code = $this->artisan('beyond:make:app Admin --full --force');
    //
    //        $code->assertOk();
    //    }
}
