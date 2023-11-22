import { type ReactElement } from 'react'

export interface FilterData {
  operator?: string
  value: any
}
export type FilterValueList = Record<string, FilterData>

type FilterItem = ReactElement
export type FilterList = Record<string, FilterItem>
