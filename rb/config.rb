# IssCurrentLocation SDK configuration

module IssCurrentLocationConfig
  def self.make_config
    {
      "main" => {
        "name" => "IssCurrentLocation",
      },
      "feature" => {
        "test" => {
          "options" => {
            "active" => false,
          },
        },
      },
      "options" => {
        "base" => "http://api.open-notify.org",
        "auth" => {
          "prefix" => "Bearer",
        },
        "headers" => {
          "content-type" => "application/json",
        },
        "entity" => {
          "iss_location" => {},
        },
      },
      "entity" => {
        "iss_location" => {
          "fields" => [
            {
              "active" => true,
              "name" => "iss_position",
              "req" => true,
              "type" => "`$OBJECT`",
              "index$" => 0,
            },
            {
              "active" => true,
              "name" => "message",
              "req" => true,
              "type" => "`$STRING`",
              "index$" => 1,
            },
            {
              "active" => true,
              "name" => "timestamp",
              "req" => true,
              "type" => "`$INTEGER`",
              "index$" => 2,
            },
          ],
          "name" => "iss_location",
          "op" => {
            "load" => {
              "input" => "data",
              "name" => "load",
              "points" => [
                {
                  "active" => true,
                  "args" => {
                    "query" => [
                      {
                        "active" => true,
                        "kind" => "query",
                        "name" => "callback",
                        "orig" => "callback",
                        "reqd" => false,
                        "type" => "`$STRING`",
                      },
                    ],
                  },
                  "method" => "GET",
                  "orig" => "/iss-now.json",
                  "parts" => [
                    "iss-now.json",
                  ],
                  "select" => {
                    "exist" => [
                      "callback",
                    ],
                  },
                  "transform" => {
                    "req" => "`reqdata`",
                    "res" => "`body`",
                  },
                  "index$" => 0,
                },
              ],
              "key$" => "load",
            },
          },
          "relations" => {
            "ancestors" => [],
          },
        },
      },
    }
  end


  def self.make_feature(name)
    require_relative 'features'
    IssCurrentLocationFeatures.make_feature(name)
  end
end
