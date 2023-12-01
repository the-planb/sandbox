import { type RuleObject } from 'rc-field-form/es/interface'
import * as BookStore from '@crud/bookstore'

export const priceValidator = async (
  rule: RuleObject,
  value: BookStore.Price,
) => {
  // if (value.length > 10) {//
  //    return await Promise.resolve()
  // }
  //
  // return await Promise.reject('El campo necesita al menos 10 caracteres')
  return await Promise.resolve()
}
