# IssCurrentLocation SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/test_feature'


module IssCurrentLocationFeatures
  def self.make_feature(name)
    case name
    when "base"
      IssCurrentLocationBaseFeature.new
    when "test"
      IssCurrentLocationTestFeature.new
    else
      IssCurrentLocationBaseFeature.new
    end
  end
end
