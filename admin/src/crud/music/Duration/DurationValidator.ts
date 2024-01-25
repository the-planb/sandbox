import { type RuleObject } from 'rc-field-form/es/interface'
import * as Music from '@crud/music'

export const durationValidator = async (
  rule: RuleObject,
  value: Music.Duration,
) => {
  if (value > 10) {
    return await Promise.resolve()
  }

  return await Promise.reject('La duración minima es 10')
  // return await Promise.resolve()
}
