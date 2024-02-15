import { BaseRecord } from '@refinedev/core'
import * as Staff from '@crud/staff'

export interface User extends BaseRecord {
  '@id': string
  id: string
  name: Staff.UserName
  email: Staff.Email
  roles: Staff.RoleList
  password: Staff.Password
}
