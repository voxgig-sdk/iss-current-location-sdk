<?php
declare(strict_types=1);

// IssCurrentLocation SDK base feature

class IssCurrentLocationBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(IssCurrentLocationContext $ctx, array $options): void {}
    public function PostConstruct(IssCurrentLocationContext $ctx): void {}
    public function PostConstructEntity(IssCurrentLocationContext $ctx): void {}
    public function SetData(IssCurrentLocationContext $ctx): void {}
    public function GetData(IssCurrentLocationContext $ctx): void {}
    public function GetMatch(IssCurrentLocationContext $ctx): void {}
    public function SetMatch(IssCurrentLocationContext $ctx): void {}
    public function PrePoint(IssCurrentLocationContext $ctx): void {}
    public function PreSpec(IssCurrentLocationContext $ctx): void {}
    public function PreRequest(IssCurrentLocationContext $ctx): void {}
    public function PreResponse(IssCurrentLocationContext $ctx): void {}
    public function PreResult(IssCurrentLocationContext $ctx): void {}
    public function PreDone(IssCurrentLocationContext $ctx): void {}
    public function PreUnexpected(IssCurrentLocationContext $ctx): void {}
}
