<?php

namespace Tests\Commands;

use Tests\TestCase;

class MakeRuleCommandTest extends TestCase
{
    public function testCanMakeRule(): void
    {
        $this->artisan('beyond:make:rule UniqueUser');

        $file = beyond_support_path('Rules/UniqueUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Rules', $contents);
        $this->assertClassName('UniqueUser', $contents);
    }

    public function testCanMakeRuleUsingForce(): void
    {
        $this->artisan('beyond:make:rule User/UniqueUser');

        $file = beyond_support_path('Rules/User/UniqueUser.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Rules\\User', $contents);
        $this->assertClassName('UniqueUser', $contents);

        $code = $this->artisan('beyond:make:rule User/UniqueUser --force');

        $code->assertOk();
    }
}
