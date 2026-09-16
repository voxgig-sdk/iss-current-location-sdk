# IssCurrentLocation SDK feature factory

from isscurrentlocation_sdk.feature.base_feature import IssCurrentLocationBaseFeature
from isscurrentlocation_sdk.feature.ratelimit_feature import IssCurrentLocationRatelimitFeature
from isscurrentlocation_sdk.feature.retry_feature import IssCurrentLocationRetryFeature
from isscurrentlocation_sdk.feature.test_feature import IssCurrentLocationTestFeature
from isscurrentlocation_sdk.feature.timeout_feature import IssCurrentLocationTimeoutFeature


_FEATURES = {
    "base": lambda: IssCurrentLocationBaseFeature(),
    "ratelimit": lambda: IssCurrentLocationRatelimitFeature(),
    "retry": lambda: IssCurrentLocationRetryFeature(),
    "test": lambda: IssCurrentLocationTestFeature(),
    "timeout": lambda: IssCurrentLocationTimeoutFeature(),
}


def _make_feature(name):
    factory = _FEATURES.get(name)
    if factory is not None:
        return factory()
    return _FEATURES["base"]()


# True when this SDK was generated with the named feature class - the
# constructor's tolerance for extend-carried features reads this (an
# active name with no generated class must not become a BaseFeature
# stray when an extend instance carries it).
def _has_feature(name):
    return name in _FEATURES
