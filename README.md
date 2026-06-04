# IssCurrentLocation SDK

Real-time latitude, longitude, and timestamp for the International Space Station

> TypeScript, Python, PHP, Golang, Ruby, Lua SDKs, a CLI, an interactive REPL, and an MCP server for AI agents — all generated from one OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).

## About ISS Current Location

The [Open Notify](http://open-notify.org/) ISS Current Location API returns where the International Space Station is right now. It is a small, single-endpoint service originally built and maintained by Nathan Bergey as a hobby project that exposes ISS tracking data in a friendly JSON form.

What you get from the API:

- `GET /iss-now.json` returns a JSON object with `message`, a Unix `timestamp`, and an `iss_position` object containing `latitude` and `longitude` strings in decimal degrees.
- JSONP is supported by appending a `?callback=...` query parameter.
- The service takes no inputs and requires no authentication or API key.

Position is computed from a Two-Line Element set that Open Notify refreshes at least once a day from NASA spaceflight data (with Celestrak listed as an alternate source). Because TLE-based propagation has inherent uncertainty larger than one second, and the position is only recomputed once per second, the docs ask clients to poll no faster than once every five seconds.

Operationally the host `api.open-notify.org` has had intermittent outages over the years, so production callers should expect occasional errors and back off accordingly. CORS is enabled, making the endpoint usable directly from browser JavaScript.

## Try it

**TypeScript**
```bash
npm install iss-current-location
```

**Python**
```bash
pip install iss-current-location-sdk
```

**PHP**
```bash
composer require voxgig/iss-current-location-sdk
```

**Golang**
```bash
go get github.com/voxgig-sdk/iss-current-location-sdk/go
```

**Ruby**
```bash
gem install iss-current-location-sdk
```

**Lua**
```bash
luarocks install iss-current-location-sdk
```

## 30-second quickstart

### TypeScript

```ts
import { IssCurrentLocationSDK } from 'iss-current-location'

const client = new IssCurrentLocationSDK({})

```

See the [TypeScript README](ts/README.md) for the
full guide, or scroll down for the same example in other languages.

## What's in the box

| Surface | Use it for | Path |
| --- | --- | --- |
| **SDK** (TypeScript, Python, PHP, Golang, Ruby, Lua) | App integration | `ts/` `py/` `php/` `go/` `rb/` `lua/` |
| **CLI** | Scripts, CI, ops, one-off API calls | `go-cli/` |
| **MCP server** | AI agents (Claude, Cursor, Cline) | `go-mcp/` |

## Use it from an AI agent (MCP)

The generated MCP server exposes every operation in this SDK as an
[MCP](https://modelcontextprotocol.io) tool that Claude, Cursor or Cline
can call directly. Build and register it:

```bash
cd go-mcp && go build -o iss-current-location-mcp .
```

Then add it to your agent's MCP config (Claude Desktop, Cursor, etc.):

```json
{
  "mcpServers": {
    "iss-current-location": {
      "command": "/abs/path/to/iss-current-location-mcp"
    }
  }
}
```

## Entities

The API exposes one entity:

| Entity | Description | API path |
| --- | --- | --- |
| **IssLocation** | The current position of the International Space Station, returned as `latitude`, `longitude`, and a Unix `timestamp` from `GET /iss-now.json` (JSONP available via `?callback=`). | `/iss-now.json` |

Each entity supports the following operations where available: **load**,
**list**, **create**, **update**, and **remove**.

## Quickstart in other languages

### Python

```python
from isscurrentlocation_sdk import IssCurrentLocationSDK

client = IssCurrentLocationSDK({})


# Load a specific isslocation
isslocation, err = client.IssLocation(None).load(
    {"id": "example_id"}, None
)
```

### PHP

```php
<?php
require_once 'isscurrentlocation_sdk.php';

$client = new IssCurrentLocationSDK([]);


// Load a specific isslocation
[$isslocation, $err] = $client->IssLocation(null)->load(
    ["id" => "example_id"], null
);
```

### Golang

```go
import sdk "github.com/voxgig-sdk/iss-current-location-sdk/go"

client := sdk.NewIssCurrentLocationSDK(map[string]any{})

```

### Ruby

```ruby
require_relative "IssCurrentLocation_sdk"

client = IssCurrentLocationSDK.new({})


# Load a specific isslocation
isslocation, err = client.IssLocation(nil).load(
  { "id" => "example_id" }, nil
)
```

### Lua

```lua
local sdk = require("iss-current-location_sdk")

local client = sdk.new({})


-- Load a specific isslocation
local isslocation, err = client:IssLocation(nil):load(
  { id = "example_id" }, nil
)
```

## Unit testing in offline mode

Every SDK ships a test mode that swaps the HTTP transport for an
in-memory mock, so unit tests run offline.

### TypeScript

```ts
const client = IssCurrentLocationSDK.test()
const result = await client.IssLocation().load({ id: 'test01' })
// result.ok === true, result.data contains mock data
```

### Python

```python
client = IssCurrentLocationSDK.test(None, None)
result, err = client.IssLocation(None).load(
    {"id": "test01"}, None
)
```

### PHP

```php
$client = IssCurrentLocationSDK::test(null, null);
[$result, $err] = $client->IssLocation(null)->load(
    ["id" => "test01"], null
);
```

### Golang

```go
client := sdk.TestSDK(nil, nil)
result, err := client.IssLocation(nil).Load(
    map[string]any{"id": "test01"}, nil,
)
```

### Ruby

```ruby
client = IssCurrentLocationSDK.test(nil, nil)
result, err = client.IssLocation(nil).load(
  { "id" => "test01" }, nil
)
```

### Lua

```lua
local client = sdk.test(nil, nil)
local result, err = client:IssLocation(nil):load(
  { id = "test01" }, nil
)
```

## How it works

Every SDK call runs the same five-stage pipeline:

1. **Point** — resolve the API endpoint from the operation definition.
2. **Spec** — build the HTTP specification (URL, method, headers, body).
3. **Request** — send the HTTP request.
4. **Response** — receive and parse the response.
5. **Result** — extract the result data for the caller.

A feature hook fires at each stage (e.g. `PrePoint`, `PreSpec`,
`PreRequest`), so features can inspect or modify the pipeline without
forking the SDK.

### Features

| Feature | Purpose |
| --- | --- |
| **TestFeature** | In-memory mock transport for testing without a live server |

Pass custom features via the `extend` option at construction time.

### Direct and Prepare

For endpoints the entity model doesn't cover, use the low-level methods:

- **`direct(fetchargs)`** — build and send an HTTP request in one step.
- **`prepare(fetchargs)`** — build the request without sending it.

Both accept a map with `path`, `method`, `params`, `query`,
`headers`, and `body`. See the [How-to guides](#how-to-guides) below.

## How-to guides

### Make a direct API call

When the entity interface does not cover an endpoint, use `direct`:

**TypeScript:**
```ts
const result = await client.direct({
  path: '/api/resource/{id}',
  method: 'GET',
  params: { id: 'example' },
})
console.log(result.data)
```

**Python:**
```python
result, err = client.direct({
    "path": "/api/resource/{id}",
    "method": "GET",
    "params": {"id": "example"},
})
```

**PHP:**
```php
[$result, $err] = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example"],
]);
```

**Go:**
```go
result, err := client.Direct(map[string]any{
    "path":   "/api/resource/{id}",
    "method": "GET",
    "params": map[string]any{"id": "example"},
})
```

**Ruby:**
```ruby
result, err = client.direct({
  "path" => "/api/resource/{id}",
  "method" => "GET",
  "params" => { "id" => "example" },
})
```

**Lua:**
```lua
local result, err = client:direct({
  path = "/api/resource/{id}",
  method = "GET",
  params = { id = "example" },
})
```

## Per-language documentation

- [TypeScript](ts/README.md)
- [Python](py/README.md)
- [PHP](php/README.md)
- [Golang](go/README.md)
- [Ruby](rb/README.md)
- [Lua](lua/README.md)

## Using the ISS Current Location

- Upstream: [http://open-notify.org/](http://open-notify.org/)
- API docs: [http://open-notify.org/Open-Notify-API/ISS-Location-Now/](http://open-notify.org/Open-Notify-API/ISS-Location-Now/)

- Open Notify documentation site is published under [CC BY 3.0 Unported](http://creativecommons.org/licenses/by/3.0/deed.en_US).
- Underlying orbital data is derived from publicly-published NASA and NORAD Two-Line Element (TLE) sets.
- No explicit terms apply to the JSON endpoint itself; treat the service as a best-effort community resource.
- Attribute Open Notify when reusing the data or documentation.

---

Generated from the ISS Current Location OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).
