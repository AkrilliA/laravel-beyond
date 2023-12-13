<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeMigrationCommandTest extends TestCase
{
    public function testCanMakeMigration(): void
    {
        $this->artisan('beyond:make:migration User.SimpleMigration');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_SimpleMigration.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ table }}', $contents);
        $this->assertStringNotContainsString('Schema::', $contents);
    }

    public function testCanMakeMigrationUsingForce(): void
    {
        $this->artisan('beyond:make:migration User.SimpleMigration');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_SimpleMigration.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ table }}', $contents);
        $this->assertStringNotContainsString('Schema::', $contents);

        $code = $this->artisan('beyond:make:migration User.SimpleMigration --force');

        $code->assertOk();
    }

    public function testCanMakeCreateMigration(): void
    {
        $this->artisan('beyond:make:migration User.CreateUsersTable');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_CreateUsersTable.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringContainsString('Schema::create', $contents);
    }

    public function testCanMakeCreateMigrationUsingForce(): void
    {
        $this->artisan('beyond:make:migration User.CreateUsersTable');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_CreateUsersTable.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringContainsString('Schema::create', $contents);

        $code = $this->artisan('beyond:make:migration User.CreateUsersTable --force');

        $code->assertOk();
    }

    public function testCanMakeUpdateMigration(): void
    {
        $this->artisan('beyond:make:migration User.AddStatusToUsersTable');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_AddStatusToUsersTable.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ table }}', $contents);
        $this->assertStringContainsString('Schema::table', $contents);
    }

    public function testCanMakeUpdateMigrationUsingForce(): void
    {
        $this->artisan('beyond:make:migration User.AddStatusToUsersTable');

        $now = new \DateTime();

        $file = beyond_infra_path('User/Database/Migrations/'.$now->format('Y_m_d_His').'_AddStatusToUsersTable.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ table }}', $contents);
        $this->assertStringContainsString('Schema::table', $contents);

        $code = $this->artisan('beyond:make:migration User.AddStatusToUsersTable --force');

        $code->assertOk();
    }
}
