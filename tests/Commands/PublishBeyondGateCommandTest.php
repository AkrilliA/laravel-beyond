<?php

namespace Tests\Commands;

use Tests\TestCase;

class PublishBeyondGateCommandTest extends TestCase
{
    public function test_can_publish_beyond_gate(): void
    {
        $this->artisan('beyond:publish:gate');

        $file = beyond_support_path('Beyond/Gate.php');
        $contents = file_get_contents($file);

        $this->assertFileExists($file);
        $this->assertNamespace('Support\\Beyond', $contents);
        $this->assertClassName('Gate', $contents);
    }
}
