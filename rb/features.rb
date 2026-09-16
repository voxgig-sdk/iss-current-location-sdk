# IssCurrentLocation SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/ratelimit_feature'
require_relative 'feature/retry_feature'
require_relative 'feature/test_feature'
require_relative 'feature/timeout_feature'


module IssCurrentLocationFeatures
  def self.make_feature(name)
    case name
    when "base"
      IssCurrentLocationBaseFeature.new
    when "ratelimit"
      IssCurrentLocationRatelimitFeature.new
    when "retry"
      IssCurrentLocationRetryFeature.new
    when "test"
      IssCurrentLocationTestFeature.new
    when "timeout"
      IssCurrentLocationTimeoutFeature.new
    else
      IssCurrentLocationBaseFeature.new
    end
  end
end
