import { type RuleObject } from 'rc-field-form/es/interface'
import * as Music from '@crud/music'

export const songNameValidator = async (
  rule: RuleObject,
  value: Music.SongName,
) => {
  // if (value.length > 10) {//
  //    return await Promise.resolve()
  // }
  //
  // return await Promise.reject('El campo necesita al menos 10 caracteres')
  return await Promise.resolve()
}
