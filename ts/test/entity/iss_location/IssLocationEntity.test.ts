
const envlocal = __dirname + '/../../../.env.local'
require('dotenv').config({ quiet: true, path: [envlocal] })

import Path from 'node:path'
import * as Fs from 'node:fs'

import { test, describe, afterEach } from 'node:test'
import assert from 'node:assert'


import { IssCurrentLocationSDK, BaseFeature, stdutil } from '../../..'

import {
  envOverride,
  liveDelay,
  makeCtrl,
  makeMatch,
  makeReqdata,
  makeStepData,
  makeValid,
  maybeSkipControl,
} from '../../utility'


describe('IssLocationEntity', async () => {

  // Per-test live pacing. Delay is read from sdk-test-control.json's
  // `test.live.delayMs`; only sleeps when ISSCURRENTLOCATION_TEST_LIVE=TRUE.
  afterEach(liveDelay('ISSCURRENTLOCATION_TEST_LIVE'))

  test('instance', async () => {
    const testsdk = IssCurrentLocationSDK.test()
    const ent = testsdk.IssLocation()
    assert(null != ent)
  })


  test('basic', async (t) => {

    const live = 'TRUE' === process.env.ISS_CURRENT_LOCATION_TEST_LIVE
    for (const op of ['load']) {
      if (maybeSkipControl(t, 'entityOp', 'iss_location.' + op, live)) return
    }

    const setup = basicSetup()
    // The basic flow consumes synthetic IDs and field values from the
    // fixture (entity TestData.json). Those don't exist on the live API.
    // Skip live runs unless the user provided a real ENTID env override.
    if (setup.syntheticOnly) {
      t.skip('live entity test uses synthetic IDs from fixture — set ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID JSON to run live')
      return
    }
    const client = setup.client
    const struct = setup.struct

    const isempty = struct.isempty
    const select = struct.select

    let iss_location_ref01_data = Object.values(setup.data.existing.iss_location)[0] as any

    // LOAD
    const iss_location_ref01_ent = client.IssLocation()
    const iss_location_ref01_match_dt0: any = {}
    const iss_location_ref01_data_dt0 = await iss_location_ref01_ent.load(iss_location_ref01_match_dt0)
    assert(null != iss_location_ref01_data_dt0)


  })
})



function basicSetup(extra?: any) {
  // TODO: fix test def options
  const options: any = {} // null

  // TODO: needs test utility to resolve path
  const entityDataFile =
    Path.resolve(__dirname, 
      '../../../../.sdk/test/entity/iss_location/IssLocationTestData.json')

  // TODO: file ready util needed?
  const entityDataSource = Fs.readFileSync(entityDataFile).toString('utf8')

  // TODO: need a xlang JSON parse utility in voxgig/struct with better error msgs
  const entityData = JSON.parse(entityDataSource)

  options.entity = entityData.existing

  let client = IssCurrentLocationSDK.test(options, extra)
  const struct = client.utility().struct
  const merge = struct.merge
  const transform = struct.transform

  let idmap = transform(
    ['iss_location01','iss_location02','iss_location03'],
    {
      '`$PACK`': ['', {
        '`$KEY`': '`$COPY`',
        '`$VAL`': ['`$FORMAT`', 'upper', '`$COPY`']
      }]
    })

  // Detect whether the user provided a real ENTID JSON via env var. The
  // basic flow consumes synthetic IDs from the fixture file; without an
  // override those synthetic IDs reach the live API and 4xx. Surface this
  // to the test so it can skip rather than fail.
  const idmapEnvVal = process.env['ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID']
  const idmapOverridden = null != idmapEnvVal && idmapEnvVal.trim().startsWith('{')

  const env = envOverride({
    'ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID': idmap,
    'ISS_CURRENT_LOCATION_TEST_LIVE': 'FALSE',
    'ISS_CURRENT_LOCATION_TEST_EXPLAIN': 'FALSE',
    'ISS_CURRENT_LOCATION_APIKEY': 'NONE',
  })

  idmap = env['ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID']

  const live = 'TRUE' === env.ISS_CURRENT_LOCATION_TEST_LIVE

  if (live) {
    client = new IssCurrentLocationSDK(merge([
      {
        apikey: env.ISS_CURRENT_LOCATION_APIKEY,
      },
      extra
    ]))
  }

  const setup = {
    idmap,
    env,
    options,
    client,
    struct,
    data: entityData,
    explain: 'TRUE' === env.ISS_CURRENT_LOCATION_TEST_EXPLAIN,
    live,
    syntheticOnly: live && !idmapOverridden,
    now: Date.now(),
  }

  return setup
}
  
