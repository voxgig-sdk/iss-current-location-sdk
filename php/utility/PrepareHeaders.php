<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: prepare_headers

class IssCurrentLocationPrepareHeaders
{
    public static function call(IssCurrentLocationContext $ctx): array
    {
        $options = $ctx->client->options_map();
        $headers = \Voxgig\Struct\Struct::getprop($options, 'headers');
        if (!$headers) {
            return [];
        }
        $out = \Voxgig\Struct\Struct::clone($headers);
        return is_array($out) ? $out : [];
    }
}
