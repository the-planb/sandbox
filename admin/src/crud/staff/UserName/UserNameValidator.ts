import { type RuleObject } from 'rc-field-form/es/interface'
import * as Staff from '@crud/staff'

export const userNameValidator = async (
  rule: RuleObject,
  value: Staff.UserName,
) => {
  // if (value.length > 10) {//
  //    return await Promise.resolve()
  // }
  //
  // return await Promise.reject('El campo necesita al menos 10 caracteres')
  return await Promise.resolve()
}
