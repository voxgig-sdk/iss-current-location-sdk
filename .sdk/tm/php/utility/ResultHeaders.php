<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: result_headers

class IssCurrentLocationResultHeaders
{
    public static function call(IssCurrentLocationContext $ctx): ?IssCurrentLocationResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
