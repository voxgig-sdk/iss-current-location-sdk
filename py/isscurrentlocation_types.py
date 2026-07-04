# Typed models for the IssCurrentLocation SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Field/param types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Do not edit by hand.

from __future__ import annotations

from dataclasses import dataclass
from typing import Optional, Any


@dataclass
class IssLocation:
    iss_position: dict
    message: str
    timestamp: int


@dataclass
class IssLocationLoadMatch:
    iss_position: Optional[dict] = None
    message: Optional[str] = None
    timestamp: Optional[int] = None

