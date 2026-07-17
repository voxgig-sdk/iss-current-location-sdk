-- IssCurrentLocation SDK configuration

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
            ["active"] = true,
            ["name"] = "iss_position",
            ["req"] = true,
            ["type"] = "`$OBJECT`",
            ["index$"] = 0,
          },
          {
            ["active"] = true,
            ["name"] = "message",
            ["req"] = true,
            ["type"] = "`$STRING`",
            ["index$"] = 1,
          },
          {
            ["active"] = true,
            ["name"] = "timestamp",
            ["req"] = true,
            ["type"] = "`$INTEGER`",
            ["index$"] = 2,
          },
        },
        ["name"] = "iss_location",
        ["op"] = {
          ["load"] = {
            ["input"] = "data",
            ["name"] = "load",
            ["points"] = {
              {
                ["active"] = true,
                ["args"] = {
                  ["query"] = {
                    {
                      ["active"] = true,
                      ["kind"] = "query",
                      ["name"] = "callback",
                      ["orig"] = "callback",
                      ["reqd"] = false,
                      ["type"] = "`$STRING`",
                    },
                  },
                },
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
                  ["res"] = "`body`",
                },
                ["index$"] = 0,
              },
            },
            ["key$"] = "load",
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
