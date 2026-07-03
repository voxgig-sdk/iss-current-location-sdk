# IssCurrentLocation SDK configuration


def make_config():
    return {
        "main": {
            "name": "IssCurrentLocation",
        },
        "feature": {
            "test": {
        "options": {
          "active": False,
        },
      },
        },
        "options": {
            "base": "http://api.open-notify.org",
            "auth": {
                "prefix": "Bearer",
            },
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
            "active": True,
            "name": "iss_position",
            "req": True,
            "type": "`$OBJECT`",
            "index$": 0,
          },
          {
            "active": True,
            "name": "message",
            "req": True,
            "type": "`$STRING`",
            "index$": 1,
          },
          {
            "active": True,
            "name": "timestamp",
            "req": True,
            "type": "`$INTEGER`",
            "index$": 2,
          },
        ],
        "name": "iss_location",
        "op": {
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "active": True,
                "args": {
                  "query": [
                    {
                      "active": True,
                      "kind": "query",
                      "name": "callback",
                      "orig": "callback",
                      "reqd": False,
                      "type": "`$STRING`",
                    },
                  ],
                },
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
                  "res": "`body`",
                },
                "index$": 0,
              },
            ],
            "key$": "load",
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
    },
    }
