# IssCurrentLocation SDK configuration

module IssCurrentLocationConfig
  # Return the process-wide config, built once on first use. The SDK reads
  # the config on every request and never writes to it, so one instance is
  # shared by every client rather than rebuilt per client.
  #
  # The returned hash is shared: treat it as read-only. Callers that need to
  # mutate should use make_config, which always returns a fresh copy.
  def self.shared_config
    @shared_config ||= make_config
  end


  # Build a fresh, fully materialised config hash. Every call rebuilds the
  # whole structure, so prefer shared_config unless you need a private copy
  # you intend to mutate.
  def self.make_config
    {
      "main" => {
        "name" => "IssCurrentLocation",
        "slug" => "iss-current-location",
        "version" => "0.0.1",
        "target" => "rb",
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
              "name" => "latitude",
              "req" => true,
              "short" => "Latitude coordinate of the ISS",
              "type" => "`$STRING`",
            },
            {
              "name" => "longitude",
              "req" => true,
              "short" => "Longitude coordinate of the ISS",
              "type" => "`$STRING`",
            },
          ],
          "name" => "iss_location",
          "op" => {
            "load" => {
              "input" => "data",
              "name" => "load",
              "points" => [
                {
                  "args" => {
                    "query" => [
                      {
                        "kind" => "query",
                        "name" => "callback",
                        "orig" => "callback",
                        "type" => "`$STRING`",
                      },
                    ],
                  },
                  "kind" => "http",
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
                    "res" => "`body.iss_position`",
                  },
                },
              ],
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
