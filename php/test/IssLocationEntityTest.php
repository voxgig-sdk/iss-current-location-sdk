<?php
declare(strict_types=1);

// IssLocation entity test

require_once __DIR__ . '/../isscurrentlocation_sdk.php';
require_once __DIR__ . '/Runner.php';

use PHPUnit\Framework\TestCase;
use Voxgig\Struct\Struct as Vs;

class IssLocationEntityTest extends TestCase
{
    public function test_create_instance(): void
    {
        $testsdk = IssCurrentLocationSDK::test(null, null);
        $ent = $testsdk->IssLocation(null);
        $this->assertNotNull($ent);
    }

    public function test_basic_flow(): void
    {
        $setup = iss_location_basic_setup(null);
        // Per-op sdk-test-control.json skip.
        $_live = !empty($setup["live"]);
        foreach (["load"] as $_op) {
            [$_shouldSkip, $_reason] = Runner::is_control_skipped("entityOp", "iss_location." . $_op, $_live ? "live" : "unit");
            if ($_shouldSkip) {
                $this->markTestSkipped($_reason ?? "skipped via sdk-test-control.json");
                return;
            }
        }
        // The basic flow consumes synthetic IDs from the fixture. In live mode
        // without an *_ENTID env override, those IDs hit the live API and 4xx.
        if (!empty($setup["synthetic_only"])) {
            $this->markTestSkipped("live entity test uses synthetic IDs from fixture — set ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID JSON to run live");
            return;
        }
        $client = $setup["client"];

        // Bootstrap entity data from existing test data.
        $iss_location_ref01_data_raw = Vs::items(Helpers::to_map(
            Vs::getpath($setup["data"], "existing.iss_location")));
        $iss_location_ref01_data = null;
        if (count($iss_location_ref01_data_raw) > 0) {
            $iss_location_ref01_data = Helpers::to_map($iss_location_ref01_data_raw[0][1]);
        }

        // LOAD
        $iss_location_ref01_ent = $client->IssLocation(null);
        $iss_location_ref01_match_dt0 = [];
        [$iss_location_ref01_data_dt0_loaded, $err] = $iss_location_ref01_ent->load($iss_location_ref01_match_dt0, null);
        $this->assertNull($err);
        $this->assertNotNull($iss_location_ref01_data_dt0_loaded);

    }
}

function iss_location_basic_setup($extra)
{
    Runner::load_env_local();

    $entity_data_file = __DIR__ . '/../../.sdk/test/entity/iss_location/IssLocationTestData.json';
    $entity_data_source = file_get_contents($entity_data_file);
    $entity_data = json_decode($entity_data_source, true);

    $options = [];
    $options["entity"] = $entity_data["existing"];

    $client = IssCurrentLocationSDK::test($options, $extra);

    // Generate idmap.
    $idmap = [];
    foreach (["iss_location01", "iss_location02", "iss_location03"] as $k) {
        $idmap[$k] = strtoupper($k);
    }

    // Detect ENTID env override before envOverride consumes it. When live
    // mode is on without a real override, the basic test runs against synthetic
    // IDs from the fixture and 4xx's. Surface this so the test can skip.
    $entid_env_raw = getenv("ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID");
    $idmap_overridden = $entid_env_raw !== false && str_starts_with(trim($entid_env_raw), "{");

    $env = Runner::env_override([
        "ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID" => $idmap,
        "ISSCURRENTLOCATION_TEST_LIVE" => "FALSE",
        "ISSCURRENTLOCATION_TEST_EXPLAIN" => "FALSE",
        "ISSCURRENTLOCATION_APIKEY" => "NONE",
    ]);

    $idmap_resolved = Helpers::to_map(
        $env["ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID"]);
    if ($idmap_resolved === null) {
        $idmap_resolved = Helpers::to_map($idmap);
    }

    if ($env["ISSCURRENTLOCATION_TEST_LIVE"] === "TRUE") {
        $merged_opts = Vs::merge([
            [
                "apikey" => $env["ISSCURRENTLOCATION_APIKEY"],
            ],
            $extra ?? [],
        ]);
        $client = new IssCurrentLocationSDK(Helpers::to_map($merged_opts));
    }

    $live = $env["ISSCURRENTLOCATION_TEST_LIVE"] === "TRUE";
    return [
        "client" => $client,
        "data" => $entity_data,
        "idmap" => $idmap_resolved,
        "env" => $env,
        "explain" => $env["ISSCURRENTLOCATION_TEST_EXPLAIN"] === "TRUE",
        "live" => $live,
        "synthetic_only" => $live && !$idmap_overridden,
        "now" => (int)(microtime(true) * 1000),
    ];
}
