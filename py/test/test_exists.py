# ProjectName SDK exists test

import pytest
from isscurrentlocation_sdk import IssCurrentLocationSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = IssCurrentLocationSDK.test(None, None)
        assert testsdk is not None
