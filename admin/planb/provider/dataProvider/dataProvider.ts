import {BaseRecord, DataProvider as IDataProvider} from "@refinedev/core";
import {GenerateQuery, PreloadHeaderCollection, PreloadHeaderItem} from "./utils";

import {ApiClient} from "@planb/provider";

export function DataProvider(): IDataProvider {
  const apiClient = ApiClient()

  return {
    getList: async ({resource, pagination, filters, sorters, meta = {}}) => {
      const query = GenerateQuery({
        filters,
        sorters,
        pagination,
      })

      const path = `${resource}?${query}`;
      const options = {
        headers: PreloadHeaderCollection(meta)
      };

      return apiClient.get(path, options)
        .then((response: Record<string, any>) => {
          return {
            total: response['hydra:totalItems'],
            data: response['hydra:member'],
          }
        })
    },
    getOne: async ({resource, id, meta = {}}) => {
      const path = `${resource}/${id}`;

      const options = {
        headers: PreloadHeaderItem(meta)
      };

      return apiClient.get(path, options)
        .then((response: BaseRecord) => {
          return {
            data: response,
          }
        })

    },

    create: async ({resource, variables}) => {
      const url = `${resource}`;

      // const {data} = await httpClient.post(url, variables);
      const data = {}
      return {
        data,
      };
    },

    update: async ({resource, id, variables}) => {
      const url = `${resource}/${id}`;
      //const {data} = await httpClient.put(url, variables);
      const data = {}

      return {
        data,
      };
    },


    deleteOne: async ({resource, id, variables}) => {
      const path = `${resource}/${id}`;

      return apiClient.delete(path)
        .then((response: BaseRecord) => {
          console.log(response)
          return {
            data: response,
          }
        })


      // // const {data} = await httpClient.delete(url, (variables as AxiosRequestConfig));
      // const data = {}
      // return {
      //   data,
      // };
    },

    deleteMany: async ({resource, ids, variables}) => {
      throw new Error('FALTA POR HACER')
    },

    getApiUrl: () => {
      return ``;
    },

    custom: async ({url, method, filters, sort, payload, query, headers}) => {
      throw new Error('FALTA POR HACER')
    },
  } as IDataProvider
}
