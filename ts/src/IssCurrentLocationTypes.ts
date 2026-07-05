// Typed models for the IssCurrentLocation SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.

export interface IssLocation {
  iss_position: Record<string, any>
  message: string
  timestamp: number
}

export interface IssLocationLoadMatch {
  iss_position?: Record<string, any>
  message?: string
  timestamp?: number
}

