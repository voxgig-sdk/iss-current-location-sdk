
import { Context } from './Context'


class IssCurrentLocationError extends Error {

  isIssCurrentLocationError = true

  sdk = 'IssCurrentLocation'

  code: string
  ctx: Context

  constructor(code: string, msg: string, ctx: Context) {
    super(msg)
    this.code = code
    this.ctx = ctx
  }

}

export {
  IssCurrentLocationError
}

