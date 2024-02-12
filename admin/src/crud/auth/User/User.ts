import { BaseRecord } from '@refinedev/core'
import * as Auth from '@crud/auth'

export interface User extends BaseRecord {
  '@id': string
  id: string
  name: Auth.UserName
  email: Auth.Email
}
