# IssCurrentLocation SDK exists test

require "minitest/autorun"
require_relative "../IssCurrentLocation_sdk"

class ExistsTest < Minitest::Test
  def test_create_test_sdk
    testsdk = IssCurrentLocationSDK.test(nil, nil)
    assert !testsdk.nil?
  end
end
