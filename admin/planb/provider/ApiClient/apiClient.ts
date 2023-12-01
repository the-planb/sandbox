'use client'

import { ApiUrl } from '@planb/provider'
import fetchJson from './fetchJson'

export type ApiClientMode = 'ProxyMode' | 'ClientMode' | 'ServerMode'

export function ApiClient(mode: ApiClientMode = 'ProxyMode') {
  const baseUrl = ApiUrl(mode)

  return {
    get: async (path: string, options: RequestInit = {}) => {
      return await fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          Accept: 'application/ld+json',
        },
        method: 'GET',
      })
    },
    put: async (path: string, data: object, options: RequestInit = {}) => {
      return await fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          Accept: 'application/ld+json',
        },
        body: JSON.stringify(data),
        method: 'PUT',
      })
    },
    post: async (path: string, data: object, options: RequestInit = {}) => {
      return await fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          Accept: 'application/ld+json',
        },
        body: JSON.stringify(data),
        method: 'POST',
      })
    },
    delete: async (path: string, options: RequestInit = {}) => {
      return await fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          Accept: 'application/ld+json',
        },
        method: 'DELETE',
      })
    },
  }
}
