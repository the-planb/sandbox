import { type RuleObject } from 'rc-field-form/es/interface'
import * as Music from '@crud/music'

export const discoNameValidator = async (
  rule: RuleObject,
  value: Music.DiscoName,
) => {
  if (value.length > 3) {
    return await Promise.resolve()
  }

  return await Promise.reject('El campo necesita al menos 3 caracteres')
}
