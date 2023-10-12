'use client'

import {ApiUrl} from "@planb/provider";
import {IriComposer} from "./iriComposer";
import fetchJson from "./fetchJson";

export type ApiClientMode = 'ProxyMode' | 'ClientMode' | 'ServerMode'

export function ApiClient(mode: ApiClientMode = 'ClientMode') {
  const baseUrl = ApiUrl(mode)

  return {
    get: async (path: string, options: RequestInit = {}) => {

      return fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          'Accept': 'application/ld+json'
        },
        method: 'GET'
      })
        // .then((data) => {
        //   return IriComposer({
        //     data,
        //     headers: options.headers
        //   })
        // })
    },
    post: async (path: string, data: object, options: RequestInit = {}) => {
      return fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          'Accept': 'application/ld+json'
        },
        body: JSON.stringify(data),
        method: 'POST'
      })
    },
    delete: async (path: string, options: RequestInit = {}) => {
      return fetchJson(baseUrl, path, {
        ...options,
        headers: {
          ...options.headers,
          'Content-Type': 'application/ld+json',
          'Accept': 'application/ld+json'
        },
        method: 'DELETE'
      })
    },
  }
}
