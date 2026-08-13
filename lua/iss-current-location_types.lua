-- Typed models for the IssCurrentLocation SDK (LuaLS annotations).
--
-- GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
-- params (op.<name>.points[].args.params[]). Field/param types come from the
-- canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
-- @voxgig/apidef VALID_CANON). Annotations only — no runtime effect. Do not
-- edit by hand.

---@class IssLocation
---@field latitude string
---@field longitude string

---@class IssLocationLoadMatch
---@field latitude? string
---@field longitude? string

local M = {}

return M
