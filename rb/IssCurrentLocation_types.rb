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
# @!attribute [rw] latitude
#   @return [String]
#
# @!attribute [rw] longitude
#   @return [String]
IssLocation = Struct.new(
  :latitude,
  :longitude,
  keyword_init: true
)

# Request payload for IssLocation#load.
#
# @!attribute [rw] latitude
#   @return [String, nil]
#
# @!attribute [rw] longitude
#   @return [String, nil]
IssLocationLoadMatch = Struct.new(
  :latitude,
  :longitude,
  keyword_init: true
)

