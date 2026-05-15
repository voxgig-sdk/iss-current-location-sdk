<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: result_body

class IssCurrentLocationResultBody
{
    public static function call(IssCurrentLocationContext $ctx): ?IssCurrentLocationResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
