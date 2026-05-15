<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: prepare_body

class IssCurrentLocationPrepareBody
{
    public static function call(IssCurrentLocationContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
