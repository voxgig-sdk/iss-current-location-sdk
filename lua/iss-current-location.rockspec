package = "voxgig-sdk-iss-current-location"
version = "0.0-1"
source = {
  url = "git://github.com/voxgig-sdk/iss-current-location-sdk.git"
}
description = {
  summary = "IssCurrentLocation SDK for Lua",
  license = "MIT"
}
dependencies = {
  "lua >= 5.3",
  "dkjson >= 2.5",
  "dkjson >= 2.5",
}
build = {
  type = "builtin",
  modules = {
    ["iss-current-location_sdk"] = "iss-current-location_sdk.lua",
    ["config"] = "config.lua",
    ["features"] = "features.lua",
  }
}
