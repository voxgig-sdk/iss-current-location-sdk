# IssCurrentLocation SDK utility: make_context
require_relative '../core/context'
module IssCurrentLocationUtilities
  MakeContext = ->(ctxmap, basectx) {
    IssCurrentLocationContext.new(ctxmap, basectx)
  }
end
