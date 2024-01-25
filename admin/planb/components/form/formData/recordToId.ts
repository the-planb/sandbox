import { Store } from 'rc-field-form/es/interface'

export const recordToId = (value: any): any => {
  if (Array.isArray(value)) {
    return value.map(recordToId)
  }

  if (typeof value === 'object' && '@id' in value) {
    return value['@id']
  }

  return value
}

const normalize = (value: any): any => {
  if (Array.isArray(value)) {
    return value.map(normalize)
  }

  if (typeof value === 'object' && '@id' in value) {
    return value['@id']
  }

  return value
}

export const recordWithUris = (store: Store | undefined): Store | undefined => {
  if (store === undefined) {
    return store
  }

  const values: Store = {}
  for (const key in store) {
    values[key] = normalize(store[key])
  }

  return values
}
