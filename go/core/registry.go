package core

var UtilityRegistrar func(u *Utility)

var NewBaseFeatureFunc func() Feature

var NewTestFeatureFunc func() Feature

var NewIssLocationEntityFunc func(client *IssCurrentLocationSDK, entopts map[string]any) IssCurrentLocationEntity

