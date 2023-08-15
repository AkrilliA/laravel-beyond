<?php

namespace Tests\Commands;

use Illuminate\Support\Str;
use Tests\TestCase;

class MakeModuleCommandTest extends TestCase
{
    public function testCanMakeModule(): void
    {
        $this->artisan('beyond:make:module User');

        $file = beyond_modules_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);
    }

    public function testCanMakeModuleUsingForce(): void
    {
        $this->artisan('beyond:make:module User');

        $file = beyond_modules_path('User/Providers/UserServiceProvider.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ module }}', $contents);

        $code = $this->artisan('beyond:make:module User --force');

        $code->assertOk();
    }

    public function testCanMakeFullModule(): void
    {
        $this->artisan('beyond:make:module User --full');

        $files = $this->getPaths();

        foreach ($files as $file) {
            match (Str::contains($file, '.')) {
                true => $this->assertFileExists($file),
                false => $this->assertDirectoryExists($file),
            };
        }
    }

    public function testCanMakeFullModuleUsingForce(): void
    {
        $this->artisan('beyond:make:module User --full');

        $files = $this->getPaths();

        foreach ($files as $file) {
            match (Str::contains($file, '.')) {
                true => $this->assertFileExists($file),
                false => $this->assertDirectoryExists($file),
            };
        }

        $code = $this->artisan('beyond:make:module User --full --force');

        $code->assertOk();
    }

    protected function getPaths(): array
    {
        return [
            beyond_modules_path('User/App/Commands'),
            beyond_modules_path('User/App/Controllers'),
            beyond_modules_path('User/App/Filters'),
            beyond_modules_path('User/App/Jobs'),
            beyond_modules_path('User/App/Middleware'),
            beyond_modules_path('User/App/Queries'),
            beyond_modules_path('User/App/Requests'),
            beyond_modules_path('User/App/Resources'),
            // TODO beyond_modules_path('User/App/routes.stub'),
            beyond_modules_path('User/Domain/Actions'),
            beyond_modules_path('User/Domain/Collections'),
            beyond_modules_path('User/Domain/DataTransferObjects'),
            beyond_modules_path('User/Domain/Events'),
            beyond_modules_path('User/Domain/Exceptions'),
            beyond_modules_path('User/Domain/Listeners'),
            beyond_modules_path('User/Domain/Models'),
            beyond_modules_path('User/Domain/Observers'),
            beyond_modules_path('User/Domain/Policies'),
            beyond_modules_path('User/Domain/Rules'),
            beyond_modules_path('User/Domain/States'),
            beyond_modules_path('User/Domain/ValueObjects'),
            beyond_modules_path('User/Infrastructure/Database/Factories'),
            beyond_modules_path('User/Infrastructure/Database/Migrations'),
            beyond_modules_path('User/Infrastructure/Database/Seeders'),
            beyond_modules_path('User/Providers/UserAuthServiceProvider.php'),
            beyond_modules_path('User/Providers/UserEventServiceProvider.php'),
            beyond_modules_path('User/Providers/UserRouteServiceProvider.php'),
            beyond_modules_path('User/Providers/UserServiceProvider.php'),
            beyond_modules_path('User/Tests/Feature'),
            beyond_modules_path('User/Tests/Unit'),
        ];
    }
}
