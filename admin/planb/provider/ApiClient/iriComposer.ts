import { JSONPath } from '@astronautlabs/jsonpath'
import fetchJson from '@planb/provider/ApiClient/fetchJson'
import zip from 'lodash/zip'
import isEmpty from 'lodash/isEmpty'
import { ApiUrl } from '@planb/provider'

interface IriComposerInput {
  data: object
  headers?: HeadersInit
}

const XPathToJson = (path: string) => {
  const jsonPath = path
    .replace(/^"/, '')
    .replace(/"$/, '')
    .split('/')
    .filter((piece) => !isEmpty(piece))
    .map((piece) => {
      return piece === '*' ? `[${piece}]` : `['${piece}']`
    })
    .join('')
  return `$${jsonPath}`
}

const HeaderToPaths = (header: string): string[] => {
  return header
    .split(',')
    .map(XPathToJson)
}

const GetIriPromises = (data: object, paths: string[], headers: HeadersInit): Map<string, Promise<any>> => {
  const promises = new Map()
  const baseUrl = ApiUrl('ServerMode')

  if ('Preload' in headers) {
    delete headers.Preload
  }

  paths.forEach((path: string) => {
    JSONPath
      .nodes(data, path)
      .forEach(({ path, value }) => {
        const key = JSONPath.stringify(path)
        promises.set(key, fetchJson(baseUrl, value, {
          headers
        }))
      })
  })

  return promises
}

function AssembleAll (data: object, keys: string[], values: object[]): object {
  zip(keys, values)
    .forEach(([path, value]) => {
      JSONPath.value(data, path, value)
    })

  return data
}

export const IriComposer = async ({ data, headers = {} }: IriComposerInput): Promise<object> => {
  const header = 'Preload' in headers
    ? headers.Preload
    : null

  if (header === null) return data

  const paths = HeaderToPaths(header)
  const promises = GetIriPromises(data, paths, headers)
  const keys = Array.from(promises.keys())
  const values = await Promise.all(promises.values())

  return AssembleAll(data, keys, values)
}
