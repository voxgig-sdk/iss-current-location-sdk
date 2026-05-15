<?php
declare(strict_types=1);

// IssCurrentLocation SDK utility registration

require_once __DIR__ . '/../core/UtilityType.php';
require_once __DIR__ . '/Clean.php';
require_once __DIR__ . '/Done.php';
require_once __DIR__ . '/MakeError.php';
require_once __DIR__ . '/FeatureAdd.php';
require_once __DIR__ . '/FeatureHook.php';
require_once __DIR__ . '/FeatureInit.php';
require_once __DIR__ . '/Fetcher.php';
require_once __DIR__ . '/MakeFetchDef.php';
require_once __DIR__ . '/MakeContext.php';
require_once __DIR__ . '/MakeOptions.php';
require_once __DIR__ . '/MakeRequest.php';
require_once __DIR__ . '/MakeResponse.php';
require_once __DIR__ . '/MakeResult.php';
require_once __DIR__ . '/MakePoint.php';
require_once __DIR__ . '/MakeSpec.php';
require_once __DIR__ . '/MakeUrl.php';
require_once __DIR__ . '/Param.php';
require_once __DIR__ . '/PrepareAuth.php';
require_once __DIR__ . '/PrepareBody.php';
require_once __DIR__ . '/PrepareHeaders.php';
require_once __DIR__ . '/PrepareMethod.php';
require_once __DIR__ . '/PrepareParams.php';
require_once __DIR__ . '/PreparePath.php';
require_once __DIR__ . '/PrepareQuery.php';
require_once __DIR__ . '/ResultBasic.php';
require_once __DIR__ . '/ResultBody.php';
require_once __DIR__ . '/ResultHeaders.php';
require_once __DIR__ . '/TransformRequest.php';
require_once __DIR__ . '/TransformResponse.php';

IssCurrentLocationUtility::setRegistrar(function (IssCurrentLocationUtility $u): void {
    $u->clean = [IssCurrentLocationClean::class, 'call'];
    $u->done = [IssCurrentLocationDone::class, 'call'];
    $u->make_error = [IssCurrentLocationMakeError::class, 'call'];
    $u->feature_add = [IssCurrentLocationFeatureAdd::class, 'call'];
    $u->feature_hook = [IssCurrentLocationFeatureHook::class, 'call'];
    $u->feature_init = [IssCurrentLocationFeatureInit::class, 'call'];
    $u->fetcher = [IssCurrentLocationFetcher::class, 'call'];
    $u->make_fetch_def = [IssCurrentLocationMakeFetchDef::class, 'call'];
    $u->make_context = [IssCurrentLocationMakeContext::class, 'call'];
    $u->make_options = [IssCurrentLocationMakeOptions::class, 'call'];
    $u->make_request = [IssCurrentLocationMakeRequest::class, 'call'];
    $u->make_response = [IssCurrentLocationMakeResponse::class, 'call'];
    $u->make_result = [IssCurrentLocationMakeResult::class, 'call'];
    $u->make_point = [IssCurrentLocationMakePoint::class, 'call'];
    $u->make_spec = [IssCurrentLocationMakeSpec::class, 'call'];
    $u->make_url = [IssCurrentLocationMakeUrl::class, 'call'];
    $u->param = [IssCurrentLocationParam::class, 'call'];
    $u->prepare_auth = [IssCurrentLocationPrepareAuth::class, 'call'];
    $u->prepare_body = [IssCurrentLocationPrepareBody::class, 'call'];
    $u->prepare_headers = [IssCurrentLocationPrepareHeaders::class, 'call'];
    $u->prepare_method = [IssCurrentLocationPrepareMethod::class, 'call'];
    $u->prepare_params = [IssCurrentLocationPrepareParams::class, 'call'];
    $u->prepare_path = [IssCurrentLocationPreparePath::class, 'call'];
    $u->prepare_query = [IssCurrentLocationPrepareQuery::class, 'call'];
    $u->result_basic = [IssCurrentLocationResultBasic::class, 'call'];
    $u->result_body = [IssCurrentLocationResultBody::class, 'call'];
    $u->result_headers = [IssCurrentLocationResultHeaders::class, 'call'];
    $u->transform_request = [IssCurrentLocationTransformRequest::class, 'call'];
    $u->transform_response = [IssCurrentLocationTransformResponse::class, 'call'];
});
