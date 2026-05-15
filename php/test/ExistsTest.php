<?php
declare(strict_types=1);

// IssCurrentLocation SDK exists test

require_once __DIR__ . '/../isscurrentlocation_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = IssCurrentLocationSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
