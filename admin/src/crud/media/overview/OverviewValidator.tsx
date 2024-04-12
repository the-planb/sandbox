import { type RuleObject } from 'rc-field-form/es/interface'
import React from 'react'
import * as Media from '@crud/media'

export const overviewValidator = async (
  rule: RuleObject,
  value: Media.Overview,
) => {
  // if (value.length > 10) {//
  //    return await Promise.resolve()
  // }
  //
  // return await Promise.reject('El campo necesita al menos 10 caracteres')
  return await Promise.resolve()
}
