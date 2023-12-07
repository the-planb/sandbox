import { Fetcher } from 'swr'
import process from 'process'
import { BaseRecord } from '@refinedev/core'

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
}: GetProps): HeadersInit => {
  if (preload?.length < 1) {
    return {}
  }

  const Preload = preload
    .map((field: string) => {
      return collection ? `"hydra:member/*/${field}"` : `"/${field}"`
    })
    .join(',') as string

  return { 'X-Preload': Preload }
}

const fetchOptions = (props: FetchDataProps): RequestInit => {
  const { path, method } = props
  switch (method) {
    case 'GET': {
      return {
        method,
        // cache: 'reload',
        headers: parsePreloadHeaders(props),
      }
    }
    case 'DELETE': {
      return {
        method,
      }
    }
    default: {
      return {
        method,
        body: props.body,
      }
    }
  }
}

const fetcher: Fetcher<object, FetchDataProps> = async (
  props: FetchDataProps,
) => {
  const serverUrl: string = process.env.NEXT_PUBLIC_ENTRYPOINT as string
  const { path, method } = props

  const options = fetchOptions(props)
  const res = await fetch(`${serverUrl}/admin/api/${path}`, options)

  if (!res.ok) return Promise.reject(await res.json())

  return await res.json()
}

export const fetchData = async (
  props: FetchDataProps,
): Promise<FetchDataReturnType> => {
  const serverUrl: string = process.env.NEXT_PUBLIC_ENTRYPOINT as string
  const { path, method } = props

  const options = fetchOptions(props)
  const res = await fetch(`${serverUrl}/admin/api/${path}`, options)

  if (!res.ok)
    return {
      error: await res.json(),
      data: undefined,
      status: res.status,
      ok: false,
    }

  const data = await res.json()

  return {
    data,
    error: undefined,
    status: res.status,
    ok: true,
  }
}
