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
}
