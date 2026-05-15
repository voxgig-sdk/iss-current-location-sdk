<?php
declare(strict_types=1);

// IssCurrentLocation SDK feature factory

require_once __DIR__ . '/feature/BaseFeature.php';
require_once __DIR__ . '/feature/TestFeature.php';


class IssCurrentLocationFeatures
{
    public static function make_feature(string $name)
    {
        switch ($name) {
            case "base":
                return new IssCurrentLocationBaseFeature();
            case "test":
                return new IssCurrentLocationTestFeature();
            default:
                return new IssCurrentLocationBaseFeature();
        }
    }
}
