

import Path from 'node:path'
import * as Fs from 'node:fs'

import { test, describe, afterEach } from 'node:test'
import assert from 'node:assert'
import { createLiveTransport } from '../../live-runner'
import { runLiveEntity } from '../../live-entity'


import { IssCurrentLocationSDK, BaseFeature, stdutil } from '../../..'

import {
  envOverride,
  liveClientOptions,
  liveDelay,
  loadEnvLocal,
  makeCtrl,
  makeMatch,
  makeReqdata,
  makeStepData,
  makeValid,
  maybeSkipControl,
} from '../../utility'


// AFTER the imports on purpose: TypeScript hoists `import` above any
// statement in the emitted CommonJS, so a loader placed above them would
// run only after every imported module had already been evaluated - and
// anything reading process.env at module scope would miss these values.
loadEnvLocal(__dirname + '/../../../.env.local')


describe('IssLocationEntity', async () => {

  // Per-test live pacing. Delay is read from sdk-test-control.json's
  // `test.live.delayMs`; only sleeps when ISS_CURRENT_LOCATION_TEST_LIVE=TRUE.
  afterEach(liveDelay('ISS_CURRENT_LOCATION_TEST_LIVE'))

  test('instance', async () => {
    const testsdk = IssCurrentLocationSDK.test()
    const ent = testsdk.IssLocation()
    assert(null != ent)
  })


  test('basic', async (t) => {

    const live = 'TRUE' === process.env.ISS_CURRENT_LOCATION_TEST_LIVE
    for (const op of ['load']) {
      if (!live && maybeSkipControl(t, 'entityOp', 'iss_location.' + op, live)) return
    }

    
    const setup = basicSetup()
    if (setup.live) {
      return runLiveEntity(setup, {"active":true,"alias":{"field":{}},"fields":[{"active":true,"name":"latitude","req":true,"short":"Latitude coordinate of the ISS","type":"`$STRING`","index$":0},{"active":true,"name":"longitude","req":true,"short":"Longitude coordinate of the ISS","type":"`$STRING`","index$":1}],"name":"iss_location","op":{"load":{"input":"data","name":"load","points":[{"active":true,"args":{"query":[{"active":true,"kind":"query","name":"callback","orig":"callback","reqd":false,"type":"`$STRING`","index$":0}]},"contract":{"id":"GET /iss-now.json","json":"{\"operationId\":\"getIssLocation\",\"parameters\":[{\"description\":\"Optional JSONP callback function name for cross-domain requests\",\"in\":\"query\",\"name\":\"callback\",\"required\":false,\"schema\":{\"type\":\"string\"}}],\"protocol\":\"http\",\"responses\":{\"200\":{\"content\":{\"application/json\":{\"example\":{\"iss_position\":{\"latitude\":\"45.0000\",\"longitude\":\"-122.0000\"},\"message\":\"success\",\"timestamp\":1609459200},\"schema\":{\"properties\":{\"iss_position\":{\"description\":\"Current position of the ISS\",\"properties\":{\"latitude\":{\"description\":\"Latitude coordinate of the ISS\",\"example\":\"45.0000\",\"type\":\"string\"},\"longitude\":{\"description\":\"Longitude coordinate of the ISS\",\"example\":\"-122.0000\",\"type\":\"string\"}},\"required\":[\"latitude\",\"longitude\"],\"type\":\"object\"},\"message\":{\"description\":\"Status message indicating success\",\"example\":\"success\",\"type\":\"string\"},\"timestamp\":{\"description\":\"Unix timestamp of when the location was recorded\",\"example\":1609459200,\"type\":\"integer\"}},\"required\":[\"message\",\"timestamp\",\"iss_position\"],\"type\":\"object\"}}},\"description\":\"Successful response with current ISS location\"},\"500\":{\"content\":{\"application/json\":{\"schema\":{\"properties\":{\"message\":{\"description\":\"Error message\",\"example\":\"error\",\"type\":\"string\"}},\"type\":\"object\"}}},\"description\":\"Internal server error\"}},\"securitySource\":\"unspecified\"}","source":"openapi3","version":1},"kind":"http","method":"GET","orig":"/iss-now.json","segments":[{"lit":"iss-now.json"}],"select":{"exist":["callback"]},"transform":{"req":"`reqdata`","res":"`body.iss_position`"},"index$":0}],"key$":"load"}},"relations":{"ancestors":[]},"key$":"iss_location","name__orig":"iss_location","Name":"IssLocation","name_":"iss_location","name-":"iss-location","NAME":"ISS_LOCATION","index$":0}, {"active":true,"entity":"iss_location","key$":"BasicIssLocationFlow","kind":"basic","name":"BasicIssLocationFlow","param":{},"step":[{"active":true,"data":{},"input":{"ref":"iss_location_ref01","srcdatavar":"iss_location_ref01_data","suffix":"_dt0"},"match":{},"op":"load","spec":[],"valid":[{"apply":"TextFieldMark","def":{"mark":"Mark01-iss_location_ref01"}}],"index$":0}]}, 'IssLocation')
    }
    const client = setup.client
    const struct = setup.struct

    const isempty = struct.isempty
    const select = struct.select

    let iss_location_ref01_data = Object.values(setup.data.existing.iss_location)[0] as any

    // LOAD
    const iss_location_ref01_ent = client.IssLocation()
    const iss_location_ref01_match_dt0: any = {}
    const iss_location_ref01_data_dt0 = (await iss_location_ref01_ent.load(iss_location_ref01_match_dt0)).data()
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

  const env = envOverride({
    'ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID': idmap,
    'ISS_CURRENT_LOCATION_TEST_LIVE': 'FALSE',
    'ISS_CURRENT_LOCATION_TEST_EXPLAIN': 'FALSE',
  })

  idmap = env['ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID']

  const live = 'TRUE' === env.ISS_CURRENT_LOCATION_TEST_LIVE

  const transport = createLiveTransport()
  if (live) {
    const rawIds = process.env['ISS_CURRENT_LOCATION_TEST_ISS_LOCATION_ENTID']
    idmap = rawIds && rawIds.trim() ? JSON.parse(rawIds) : {}
    if (!idmap || Array.isArray(idmap) || typeof idmap !== 'object') {
      throw new Error('Live ENTID must be a JSON object')
    }
    client = new IssCurrentLocationSDK(merge([
      // FIRST, so the generated fields below win: sdk-test-control.json's
      // test.client.options adds to the live client, it does not redirect it.
      liveClientOptions(),
      {
      },
      // 'extra || {}', not a bare 'extra': struct.merge returns UNDEFINED when the
      // last entry is undefined, and basicSetup is normally called with no
      // argument at all - so a bare 'extra' silently discarded the apikey
      // and server values above and handed the SDK undefined. Harmless
      // while there was nothing in that object; not harmless now.
      extra || {},
      { system: { fetch: transport.fetch } }
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
    transport,
    now: Date.now(),
  }

  return setup
}
  
