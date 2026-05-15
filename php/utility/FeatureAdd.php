<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: feature_add

class IssCurrentLocationFeatureAdd
{
    public static function call(IssCurrentLocationContext $ctx, mixed $f): void
    {
        $ctx->client->features[] = $f;
    }
}
