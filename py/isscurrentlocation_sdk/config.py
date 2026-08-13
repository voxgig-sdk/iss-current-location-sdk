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
            "name": "latitude",
            "req": True,
            "type": "`$STRING`",
            "index$": 0,
          },
          {
            "active": True,
            "name": "longitude",
            "req": True,
            "type": "`$STRING`",
            "index$": 1,
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
