# IssCurrentLocation SDK configuration


_shared_config = None


def shared_config():
    """Return the process-wide config, built once on first use.

    The SDK reads the config on every request and never writes to it, so one
    instance is shared by every client rather than rebuilt per client.

    The returned dict is shared: treat it as read-only. Callers that need to
    mutate should use make_config, which always returns a fresh copy.
    """
    global _shared_config
    if _shared_config is None:
        _shared_config = make_config()
    return _shared_config


def make_config():
    """Build a fresh, fully materialised config dict.

    Every call rebuilds the whole structure, so prefer shared_config unless
    you need a private copy you intend to mutate.
    """
    return {
        "main": {
            "name": "IssCurrentLocation",
            "slug": "iss-current-location",
            "version": "0.0.1",
            "target": "py",
        },
        "feature": {
            "test": {
        "options": {
          "active": False,
        },
        "transport": "base",
      },
        },
        "options": {
            "base": "http://api.open-notify.org",
            "headers": {
        "content-type": "application/json",
      },
            "entity": {
                "iss_location": {},
            },
        },
        "entity": {
      "iss_location": {
        "fields": [
          {
            "name": "latitude",
            "req": True,
            "short": "Latitude coordinate of the ISS",
            "type": "`$STRING`",
          },
          {
            "name": "longitude",
            "req": True,
            "short": "Longitude coordinate of the ISS",
            "type": "`$STRING`",
          },
        ],
        "name": "iss_location",
        "op": {
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "args": {
                  "query": [
                    {
                      "kind": "query",
                      "name": "callback",
                      "orig": "callback",
                      "type": "`$STRING`",
                    },
                  ],
                },
                "kind": "http",
                "method": "GET",
                "orig": "/iss-now.json",
                "parts": [
                  "iss-now.json",
                ],
                "select": {
                  "exist": [
                    "callback",
                  ],
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body.iss_position`",
                },
              },
            ],
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
    },
    }
