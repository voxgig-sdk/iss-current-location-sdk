-- Typed models for the IssCurrentLocation SDK (LuaLS annotations).
--
-- GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
-- params (op.<name>.points[].args.params[]). Field/param types come from the
-- canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
-- @voxgig/apidef VALID_CANON). Annotations only — no runtime effect. Do not
-- edit by hand.

---@class IssLocation
---@field iss_position table
---@field message string
---@field timestamp number

---@class IssLocationLoadMatch
---@field iss_position? table
---@field message? string
---@field timestamp? number

local M = {}

return M
