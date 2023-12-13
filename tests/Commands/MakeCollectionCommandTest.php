<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeCollectionCommandTest extends TestCase
{
    public function testCanMakeCollection(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeCollectionUsingForce(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:collection User.UserCollection --force');

        $code->assertOk();
    }

    public function testCanMakeCollectionWithModel(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection --model=User');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);
    }

    public function testCanMakeCollectionWithModelUsingForce(): void
    {
        $this->artisan('beyond:make:collection User.UserCollection --model=User');

        $file = beyond_domain_path('User/Collections/UserCollection.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $file = beyond_domain_path('User/Models/User.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertStringNotContainsString('{{ namespace }}', $contents);
        $this->assertStringNotContainsString('{{ className }}', $contents);

        $code = $this->artisan('beyond:make:collection User.UserCollection --model=User --force');
        $code->assertOk();
    }
}
