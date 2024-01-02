import { type DataProvider as IDataProvider } from '@refinedev/core'
import { GenerateQuery } from './utils'

// import { ApiClient } from '@planb/provider'
import { fetchData } from '@planb/provider/fetchData'

export function DataProvider(): IDataProvider {
  // const apiClient = ApiClient('ProxyMode')

  return {
    getList: async ({ resource, pagination, filters, sorters, meta = {} }) => {
      const query = GenerateQuery({
        filters,
        sorters,
        pagination,
      })

      const { error, data, status } = await fetchData({
        path: `api/${resource}?${query}`,
        method: 'GET',
        collection: true,
        preload: meta.preload,
      })

      if (error) {
        return Promise.reject({
          message: error['hydra:description'] || 'An error occurred',
          statusCode: status,
        })
      }

      return {
        total: data['hydra:totalItems'],
        data: data['hydra:member'],
      }
    },
    getOne: async ({ resource, id, meta = {} }) => {
      const { error, data, status } = await fetchData({
        path: `api/${resource}/${id}`,
        method: 'GET',
        collection: false,
        // preload: meta.preload,
      })

      if (error) {
        return Promise.reject({
          message: error['hydra:description'] || 'An error occurred',
          statusCode: status,
        })
      }

      return {
        data,
      }
    },

    create: async ({ resource, variables }) => {
      const { error, data, status } = await fetchData({
        path: `api/${resource}`,
        method: 'POST',
        body: JSON.stringify(variables) as BodyInit,
      })

      if (error) {
        return Promise.reject({
          message: error['hydra:description'] || 'An error occurred',
          statusCode: status,
        })
      }

      return {
        data,
      }
    },

    update: async ({ resource, id, variables }) => {
      const { error, data, status } = await fetchData({
        path: `api/${resource}/${id}`,
        method: 'PUT',
        body: JSON.stringify(variables) as BodyInit,
      })

      if (error) {
        return Promise.reject({
          message: error['hydra:description'] || 'An error occurred',
          statusCode: status,
        })
      }

      return {
        data,
      }
    },

    deleteOne: async ({ resource, id, variables }) => {
      const path = `${resource}/${id}`

      const { error, data, status } = await fetchData({
        path: `api/${resource}/${id}`,
        method: 'DELETE',
      })

      if (error) {
        return Promise.reject({
          message: error['hydra:description'] || 'An error occurred',
          statusCode: status,
        })
      }

      return {
        data,
      }
    },

    deleteMany: async ({ resource, ids, variables }) => {
      throw new Error('FALTA POR HACER')
    },

    getApiUrl: () => {
      return ''
    },

    custom: async ({ url, method, filters, sort, payload, query, headers }) => {
      throw new Error('FALTA POR HACER')
    },
  } as IDataProvider
}
