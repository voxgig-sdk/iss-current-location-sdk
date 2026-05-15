<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class IssCurrentLocationMakeContext
{
    public static function call(array $ctxmap, ?IssCurrentLocationContext $basectx): IssCurrentLocationContext
    {
        return new IssCurrentLocationContext($ctxmap, $basectx);
    }
}
