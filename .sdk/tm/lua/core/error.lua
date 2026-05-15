-- IssCurrentLocation SDK error

local IssCurrentLocationError = {}
IssCurrentLocationError.__index = IssCurrentLocationError


function IssCurrentLocationError.new(code, msg, ctx)
  local self = setmetatable({}, IssCurrentLocationError)
  self.is_sdk_error = true
  self.sdk = "IssCurrentLocation"
  self.code = code or ""
  self.msg = msg or ""
  self.ctx = ctx
  self.result = nil
  self.spec = nil
  return self
end


function IssCurrentLocationError:error()
  return self.msg
end


function IssCurrentLocationError:__tostring()
  return self.msg
end


return IssCurrentLocationError
