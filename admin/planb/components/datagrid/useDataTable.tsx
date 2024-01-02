import { ListProps, useTable, useTableProps } from '@refinedev/antd'
import { BaseRecord, CrudFilters, HttpError, useTranslate } from '@refinedev/core'
import { FlexProps, TableProps } from 'antd'
import { ActionList, FilterList, FilterValueList, makeActions, SearchFormProps } from '@planb/components'
import { ReactNode } from 'react'

import { gridCss as css } from '@planb/components/datagrid'

export type UseDataTableProps<TData extends BaseRecord> = useTableProps<
  TData,
  HttpError,
  FilterValueList,
  TData
> & {
  columns: TableProps<TData>['columns']
  filters?: FilterList
  actions?: ActionList<TData>
  headerButtons: ReactNode
}

export type UseDataTableReturnType<TData extends BaseRecord> = {
  listProps: ListProps
  flexProps: Omit<FlexProps, 'children'>
  tableProps: TableProps<TData>
  searchProps: SearchFormProps
  hasFilters: boolean
}

export const useDataTable = <TData extends BaseRecord>({
                                                         resource,
                                                         columns,
                                                         filters = {},
                                                         actions = {},
                                                         headerButtons,
                                                         ...props
                                                       }: UseDataTableProps<TData>): UseDataTableReturnType<TData> => {
  const t = useTranslate()

  const {
    tableProps: _tableProps,
    filters: _filters,
    searchFormProps,
  } = useTable({
    resource,
    filters: {
      mode: 'server',
      defaultBehavior: 'replace',
    },
    sorters: {
      initial: [
        {
          field: 'id',
          order: 'asc',
        },
      ],
    },
    onSearch: (input: FilterValueList): CrudFilters => {
      return Object.entries(input).map(([field, value]) => {
        return {
          field,
          ...value,
        }
      }) as CrudFilters
    },
    ...props,
  })

  const listProps: ListProps = {
    resource,
    breadcrumb: true,
    wrapperProps: {
      className: css.wrapper,
    },
    headerButtons,
    title: t('titles.list', { ns: resource }),
  }

  const flexProps: Omit<FlexProps, 'children'> = {
    style: { backgroundColor: 'white', height: '100%' },
    gap: 20,
  }

  const searchProps: SearchFormProps = {
    resource,
    cardProps: {
      bordered: true,
    },
    formProps: searchFormProps,
    filters,
  }

  const tableProps: TableProps<TData> = {
    ..._tableProps,
    scroll: {
      y: 1000,
      x: true,
    },
    pagination: {
      pageSize: 10,
      ..._tableProps.pagination,
      hideOnSinglePage: true,
      showSizeChanger: false,
    },
    rowKey: 'id',
    columns: [
      ...(columns || []),
      makeActions({
        resource: resource as string,
        actions,
      }),
    ],
  }

  return {
    listProps,
    flexProps,
    tableProps,
    searchProps,
    hasFilters: Object.keys(filters).length > 0,
  }
}
