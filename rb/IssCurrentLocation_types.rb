# frozen_string_literal: true

# Typed models for the IssCurrentLocation SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Member types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Ruby types are unenforced; these YARD
# annotations document the shapes. Do not edit by hand.

# IssLocation entity data model.
#
# @!attribute [rw] iss_position
#   @return [Hash]
#
# @!attribute [rw] message
#   @return [String]
#
# @!attribute [rw] timestamp
#   @return [Integer]
IssLocation = Struct.new(
  :iss_position,
  :message,
  :timestamp,
  keyword_init: true
)

# Match filter for IssLocation#load (any subset of IssLocation fields).
#
# @!attribute [rw] iss_position
#   @return [Hash, nil]
#
# @!attribute [rw] message
#   @return [String, nil]
#
# @!attribute [rw] timestamp
#   @return [Integer, nil]
IssLocationLoadMatch = Struct.new(
  :iss_position,
  :message,
  :timestamp,
  keyword_init: true
)

