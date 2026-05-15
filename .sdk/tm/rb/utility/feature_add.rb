# IssCurrentLocation SDK utility: feature_add
module IssCurrentLocationUtilities
  FeatureAdd = ->(ctx, f) {
    ctx.client.features << f
  }
end
