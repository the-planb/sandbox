import process from 'process'
import { BaseRecord } from '@refinedev/core'
import { iriComposer } from '@planb/provider/fetchData/iriComposer'

type GetProps = {
  path: string
  method: 'GET'
  preload?: string[]
  collection?: boolean
}

type PostProps = {
  path: string
  method: 'POST' | 'PUT'
  body: BodyInit
}
type DeleteProps = {
  path: string
  method: 'DELETE'
}

type FetchDataProps = GetProps | PostProps | DeleteProps

type FetchDataReturnType =
  | {
      data: undefined
      error: {
        'hydra:description': string
        'hydra:title': string
      }
      status: number
      ok: false
    }
  | {
      data: HydraResponse
      error: undefined
      status: number
      ok: true
    }

type HydraResponse = {
  'hydra:totalItems': number
  'hydra:member': BaseRecord[]
}

const parsePreloadHeaders = ({
  collection,
  preload = [],
}: GetProps): string | null => {
  if (preload?.length < 1) {
    return null
  }

  return preload
    .map((field: string) => {
      return collection ? `"hydra:member/*/${field}"` : `"/${field}"`
    })
    .join(',') as string
}

const fetchOptions = (props: FetchDataProps): RequestInit => {
  const { path, method } = props

  const headers = {
    'Content-Type': 'application/ld+json',
    Accept: 'application/ld+json',
  }

  switch (method) {
    case 'GET': {
      return {
        method,
        headers: headers,
      }
    }
    case 'DELETE': {
      return {
        method,
        headers,
      }
    }
    default: {
      return {
        method,
        headers,
        body: props.body,
      }
    }
  }
}

const formatData = async (res: Response, options: RequestInit) => {
  const responseText = await res.text()
  try {
    if (res.status === 204 && options.method === 'DELETE') {
      return {
        data: {},
        status: 200,
        ok: true,
      }
    }

    const data = JSON.parse(responseText)
    return {
      data,
      status: res.status,
      ok: true,
    }
  } catch (error) {
    return Promise.reject({
      data: {
        raw: responseText,
      },
      status: res.status,
      ok: false,
    })
  }
}

export const fetchData = async (
  props: FetchDataProps,
): Promise<FetchDataReturnType> => {
  const baseUrl: string = process.env.NEXT_PUBLIC_ENTRYPOINT as string
  const { path } = props
  const options = fetchOptions(props)

  return fetch(`${baseUrl}/${path}`, options)
    .then(async (res) => {
      const responseText = await res.text()
      try {
        if (res.status === 204 && options.method === 'DELETE') {
          return {
            data: {},
            status: 200,
            ok: true,
          }
        }

        if (res.status < 200 || res.status >= 300) {
          return {
            data: undefined,
            status: res.status,
            error: JSON.parse(responseText),
          }
        }

        const data =
          props.method === 'GET'
            ? await iriComposer({
                baseUrl,
                preload: parsePreloadHeaders(props),
                data: JSON.parse(responseText),
                options,
              })
            : JSON.parse(responseText)

        return {
          data,
          status: 200,
          error: undefined,
        }
      } catch (error) {
        return Promise.reject({
          data: {
            raw: responseText,
          },
          status: res.status,
          ok: false,
        })
      }
    })
    .catch((error) => {
      return error
    })
}
