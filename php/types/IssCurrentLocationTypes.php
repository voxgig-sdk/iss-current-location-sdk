<?php
declare(strict_types=1);

// Typed models for the IssCurrentLocation SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.
//
// These are documentation-grade value objects (PHP 8 typed properties),
// registered on the composer classmap autoload. The SDK boundary exchanges
// assoc-arrays; these classes name the shapes for tooling and typed callers.

/** IssLocation entity data model. */
class IssLocation
{
    public array $iss_position;
    public string $message;
    public int $timestamp;
}

/** Match filter for IssLocation#load (any subset of IssLocation fields). */
class IssLocationLoadMatch
{
    public ?array $iss_position = null;
    public ?string $message = null;
    public ?int $timestamp = null;
}

