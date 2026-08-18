-- IssCurrentLocation SDK configuration

-- Build a fresh, fully materialised config table. Every call rebuilds the
-- whole structure, so prefer require("config_shared") unless you need a
-- private copy you intend to mutate.
local function make_config()
  return {
    main = {
      name = "IssCurrentLocation",
    },
    feature = {
      ["test"] = {
        ["options"] = {
          ["active"] = false,
        },
      },
    },
    options = {
      base = "http://api.open-notify.org",
      headers = {
        ["content-type"] = "application/json",
      },
      entity = {
        ["iss_location"] = {},
      },
    },
    entity = {
      ["iss_location"] = {
        ["fields"] = {
          {
            ["name"] = "latitude",
            ["req"] = true,
            ["type"] = "`$STRING`",
          },
          {
            ["name"] = "longitude",
            ["req"] = true,
            ["type"] = "`$STRING`",
          },
        },
        ["name"] = "iss_location",
        ["op"] = {
          ["load"] = {
            ["input"] = "data",
            ["name"] = "load",
            ["points"] = {
              {
                ["args"] = {
                  ["query"] = {
                    {
                      ["kind"] = "query",
                      ["name"] = "callback",
                      ["orig"] = "callback",
                      ["type"] = "`$STRING`",
                    },
                  },
                },
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/iss-now.json",
                ["parts"] = {
                  "iss-now.json",
                },
                ["select"] = {
                  ["exist"] = {
                    "callback",
                  },
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body.iss_position`",
                },
              },
            },
          },
        },
        ["relations"] = {
          ["ancestors"] = {},
        },
      },
    },
  }
end


local function make_feature(name)
  local features = require("features")
  local factory = features[name]
  if factory ~= nil then
    return factory()
  end
  return features.base()
end


-- Attach make_feature to the SDK class
local function setup_sdk(SDK)
  SDK._make_feature = make_feature
end


return make_config
