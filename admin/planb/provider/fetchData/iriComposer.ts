import { JSONPath } from '@astronautlabs/jsonpath'
import zip from 'lodash/zip'
import isEmpty from 'lodash/isEmpty'

interface IriComposerInput {
  baseUrl: string
  data: object
  preload: string | null
  options: RequestInit
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
  return header.split(',').map(XPathToJson)
}

export const iriComposer = async (props: IriComposerInput): Promise<object> => {
  const { baseUrl, preload, data, options } = props

  if (preload === null) return data

  const promises = new Map()
  preload
    .split(',')
    .map(XPathToJson)
    .forEach((path, value) => {
      JSONPath.nodes(data, path).forEach(({ path, value }) => {
        const key = JSONPath.stringify(path)

        const partial = ((value: string | string[]) => {
          // if (value instanceof Array) {
          //   const temp = value.map((item) => {
          //     return fetch(`${baseUrl}${item}`, options).then((res) => {
          //       return res.json()
          //     })
          //   })
          //   return Promise.all(temp)
          // }

          return fetch(`${baseUrl}${value}`, options).then((res) => {
            return res.json()
          })
        })(value)

        promises.set(key, partial)
      })
    })

  const keys = Array.from(promises.keys())

  try {
    const values = await Promise.all(promises.values())

    zip(keys, values).forEach(([path, value]) => {
      JSONPath.value(data, path, value)
    })

    return data
  } catch (err) {
    console.log({ err })
    return {}
  }
}
