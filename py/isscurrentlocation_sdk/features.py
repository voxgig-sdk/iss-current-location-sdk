# IssCurrentLocation SDK feature factory

from isscurrentlocation_sdk.feature.base_feature import IssCurrentLocationBaseFeature
from isscurrentlocation_sdk.feature.test_feature import IssCurrentLocationTestFeature


def _make_feature(name):
    features = {
        "base": lambda: IssCurrentLocationBaseFeature(),
        "test": lambda: IssCurrentLocationTestFeature(),
    }
    factory = features.get(name)
    if factory is not None:
        return factory()
    return features["base"]()
