<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeModelCommandTest extends TestCase
{
    public function testCanMakeModel(): void
    {
        $this->artisan('beyond:make:model User.User');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeModelUsingForce(): void
    {
        $this->artisan('beyond:make:model User.User');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:model User.User --force');

        $code->assertOk();
    }

    public function testCanMakeModelWithFactory(): void
    {
        $this->markTestSkipped('Not implemented yet!');

        /* @phpstan-ignore-next-line */
        $this->artisan('beyond:make:model User.User --factory');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_infra_path('User/Infrastructure/Factories/UserFactory.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ model }}', $contents);
    }

    public function testCanMakeModelWithFactoryUsingForce(): void
    {
        $this->markTestSkipped('Not implemented yet!');

        /* @phpstan-ignore-next-line */
        $this->artisan('beyond:make:model User.User --factory');

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_infra_path('User/Factories/UserFactory.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ model }}', $contents);

        $code = $this->artisan('beyond:make:model User.User --factory --force');

        $code->assertOk();
    }

    public function testCanMakeModelWithMigration(): void
    {
        $this->artisan('beyond:make:model User.User --migration');

        $now = new \DateTime();

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_create_users_table.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringContainsString('Schema::create', $contents);
    }

    public function testCanMakeModelWithMigrationUsingForce(): void
    {
        $this->artisan('beyond:make:model User.User --migration');

        $now = new \DateTime();

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_create_users_table.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringContainsString('Schema::create', $contents);

        $code = $this->artisan('beyond:make:model User.User --migration --force');

        $code->assertOk();
    }
}
