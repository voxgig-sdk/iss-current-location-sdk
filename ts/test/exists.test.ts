
import { test, describe } from 'node:test'
import { equal } from 'node:assert'


import { IssCurrentLocationSDK } from '..'


describe('exists', async () => {

  test('test-mode', async () => {
    const testsdk = await IssCurrentLocationSDK.test()
    equal(null !== testsdk, true)
  })

})
