package sdktest

import (
	"encoding/json"
	"os"
	"path/filepath"
	"runtime"
	"strings"
	"testing"
	"time"

	sdk "github.com/voxgig-sdk/iss-current-location-sdk/go"
	"github.com/voxgig-sdk/iss-current-location-sdk/go/core"

	vs "github.com/voxgig-sdk/iss-current-location-sdk/go/utility/struct"
)

func TestIssLocationEntity(t *testing.T) {
	t.Run("instance", func(t *testing.T) {
		testsdk := sdk.TestSDK(nil, nil)
		ent := testsdk.IssLocation(nil)
		if ent == nil {
			t.Fatal("expected non-nil IssLocationEntity")
		}
	})

	t.Run("basic", func(t *testing.T) {
		setup := iss_locationBasicSetup(nil)
		// Per-op sdk-test-control.json skip — basic test exercises a flow
		// with multiple ops; skipping any op skips the whole flow.
		_mode := "unit"
		if setup.live {
			_mode = "live"
		}
		for _, _op := range []string{"load"} {
			if _shouldSkip, _reason := isControlSkipped("entityOp", "iss_location." + _op, _mode); _shouldSkip {
				if _reason == "" {
					_reason = "skipped via sdk-test-control.json"
				}
				t.Skip(_reason)
				return
			}
		}
		// The basic flow consumes synthetic IDs from the fixture. In live mode
		// without an *_ENTID env override, those IDs hit the live API and 4xx.
		if setup.syntheticOnly {
			t.Skip("live entity test uses synthetic IDs from fixture — set ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID JSON to run live")
			return
		}
		client := setup.client

		// Bootstrap entity data from existing test data (no create step in flow).
		issLocationRef01DataRaw := vs.Items(core.ToMapAny(vs.GetPath("existing.iss_location", setup.data)))
		var issLocationRef01Data map[string]any
		if len(issLocationRef01DataRaw) > 0 {
			issLocationRef01Data = core.ToMapAny(issLocationRef01DataRaw[0][1])
		}
		// Discard guards against Go's unused-var check when the flow's steps
		// happen not to consume the bootstrap data (e.g. list-only flows).
		_ = issLocationRef01Data

		// LOAD
		issLocationRef01Ent := client.IssLocation(nil)
		issLocationRef01MatchDt0 := map[string]any{}
		issLocationRef01DataDt0Loaded, err := issLocationRef01Ent.Load(issLocationRef01MatchDt0, nil)
		if err != nil {
			t.Fatalf("load failed: %v", err)
		}
		if issLocationRef01DataDt0Loaded == nil {
			t.Fatal("expected load result to be non-nil")
		}

	})
}

func iss_locationBasicSetup(extra map[string]any) *entityTestSetup {
	loadEnvLocal()

	_, filename, _, _ := runtime.Caller(0)
	dir := filepath.Dir(filename)

	entityDataFile := filepath.Join(dir, "..", "..", ".sdk", "test", "entity", "iss_location", "IssLocationTestData.json")

	entityDataSource, err := os.ReadFile(entityDataFile)
	if err != nil {
		panic("failed to read iss_location test data: " + err.Error())
	}

	var entityData map[string]any
	if err := json.Unmarshal(entityDataSource, &entityData); err != nil {
		panic("failed to parse iss_location test data: " + err.Error())
	}

	options := map[string]any{}
	options["entity"] = entityData["existing"]

	client := sdk.TestSDK(options, extra)

	// Generate idmap via transform, matching TS pattern.
	idmap := vs.Transform(
		[]any{"iss_location01", "iss_location02", "iss_location03"},
		map[string]any{
			"`$PACK`": []any{"", map[string]any{
				"`$KEY`": "`$COPY`",
				"`$VAL`": []any{"`$FORMAT`", "upper", "`$COPY`"},
			}},
		},
	)

	// Detect ENTID env override before envOverride consumes it. When live
	// mode is on without a real override, the basic test runs against synthetic
	// IDs from the fixture and 4xx's. Surface this so the test can skip.
	entidEnvRaw := os.Getenv("ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID")
	idmapOverridden := entidEnvRaw != "" && strings.HasPrefix(strings.TrimSpace(entidEnvRaw), "{")

	env := envOverride(map[string]any{
		"ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID": idmap,
		"ISSCURRENTLOCATION_TEST_LIVE":      "FALSE",
		"ISSCURRENTLOCATION_TEST_EXPLAIN":   "FALSE",
		"ISSCURRENTLOCATION_APIKEY":         "NONE",
	})

	idmapResolved := core.ToMapAny(env["ISSCURRENTLOCATION_TEST_ISS_LOCATION_ENTID"])
	if idmapResolved == nil {
		idmapResolved = core.ToMapAny(idmap)
	}

	if env["ISSCURRENTLOCATION_TEST_LIVE"] == "TRUE" {
		mergedOpts := vs.Merge([]any{
			map[string]any{
				"apikey": env["ISSCURRENTLOCATION_APIKEY"],
			},
			extra,
		})
		client = sdk.NewIssCurrentLocationSDK(core.ToMapAny(mergedOpts))
	}

	live := env["ISSCURRENTLOCATION_TEST_LIVE"] == "TRUE"
	return &entityTestSetup{
		client:        client,
		data:          entityData,
		idmap:         idmapResolved,
		env:           env,
		explain:       env["ISSCURRENTLOCATION_TEST_EXPLAIN"] == "TRUE",
		live:          live,
		syntheticOnly: live && !idmapOverridden,
		now:           time.Now().UnixMilli(),
	}
}
