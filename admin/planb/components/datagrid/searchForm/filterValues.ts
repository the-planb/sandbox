import { type ReactElement } from 'react'

type FilterItem = ReactElement

export interface FilterData {
  operator?: string
  value: any
}

export type FilterValueList = Record<string, FilterData>
export type FilterList = { [key: string]: FilterItem }

export const defaultFilters = (
  filters: FilterList,
  defaultValues?: FilterValueList,
): FilterValueList => {
  const emptyValues = Object.keys(filters).reduce((carry, name) => {
    return {
      ...carry,
      [name]: {
        operator: undefined,
        value: null,
      },
    }
  }, {})

  return {
    ...emptyValues,
    ...defaultValues,
  }
}
