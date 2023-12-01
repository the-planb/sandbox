import React, { type FC, type ReactNode } from 'react'
import { List, useTable, type useTableProps } from '@refinedev/antd'
import { Col, Row, Table, type TableProps } from 'antd'
import { ColumnActions } from './actionsColumn/ColumnActions'
import css from './style.module.scss'
import { type FormDataProps } from '@planb/components/form'
import { useListForms } from '@planb/components/table/tableData/useListForms/useListForms'
import { type BaseRecord, type HttpError } from '@refinedev/core'
import { type ActionList } from '@planb/components/table/tableData/types'
import { buttonProps } from '@planb/components/table/tableData/buttonProps'
import { FilterPanel } from '@planb/components/table/tableData/filterPanel/FilterPanel'
import {
  type FilterList,
  type FilterValueList,
} from '@planb/components/table/tableData/filterPanel/types'
import {
  getFiltersRecord,
  onSearch,
} from '@planb/components/table/tableData/utils'

type ActionMode =
  | {
      modal: FC<FormDataProps>
      width?: string | number
      drawer?: never
    }
  | {
      drawer: FC<FormDataProps>
      width?: string | number
      modal?: never
    }

interface TableDataProps<
  TQueryFnData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TSearchVariables extends FilterValueList = FilterValueList,
  TData extends BaseRecord = TQueryFnData,
> extends useTableProps<TQueryFnData, TError, TSearchVariables, TData> {
  resource: string
  children: ReactNode | ReactNode[]
  actions?: ActionList
  edit?: ActionMode
  create?: ActionMode
  filters?: FilterList
  filtersDefaultValues?: FilterValueList
  tableProps?: TableProps<TData>
}

export const TableData = <
  TQueryFnData extends BaseRecord = BaseRecord,
  TError extends HttpError = HttpError,
  TSearchVariables extends FilterValueList = FilterValueList,
  TData extends BaseRecord = TQueryFnData,
>(
  props: TableDataProps<TQueryFnData, TError, TSearchVariables, TData>,
) => {
  const {
    children,
    edit,
    create,
    actions,
    filters,
    filtersDefaultValues,
    tableProps: tableParams,
    ...params
  } = props
  const { resource } = props

  const {
    searchFormProps: _searchFormProps,
    filters: filterValues,
    tableProps: _tableProps,
  } = useTable<TQueryFnData, TError, TSearchVariables, TData>({
    ...params,
    sorters: {
      initial: [
        {
          field: 'id',
          order: 'asc',
        },
      ],
      ...params.sorters,
    },
    filters: {
      mode: 'server',
      defaultBehavior: 'replace',
    },
    syncWithLocation: true,
    pagination: {
      pageSize: 10,
    },
    onSearch,
  })

  const tableProps = {
    ...props.tableProps,
    ..._tableProps,
    scroll: { y: '69vh' },
    pagination: {
      ..._tableProps.pagination,
      showSizeChanger: false,
      hideOnSinglePage: true,
    },
  }

  const searchFormProps = {
    ..._searchFormProps,
    initialValues: getFiltersRecord(filterValues),
  }

  const { showEdit, editForm, showCreate, createForm } = useListForms({
    resource,
    edit,
    create,
  })

  const hasFilters = Object.keys(filters ?? {}).length > 0
  const md = hasFilters ? 19 : 24

  return (
    <>
      <List
        resource={resource}
        breadcrumb={false}
        wrapperProps={{
          className: css.tableData,
        }}
        createButtonProps={{
          icon: false,
          ...buttonProps(showCreate),
        }}>
        <Row>
          {hasFilters && (
            <Col className={'filterWrapper'} sm={24} md={5}>
              <FilterPanel
                {...searchFormProps}
                resource={resource}
                filters={filters as FilterList}
                defaultValues={filtersDefaultValues}
              />
            </Col>
          )}

          <Col sm={24} md={md}>
            <Table {...tableProps} rowKey='id'>
              {children}

              {ColumnActions({
                resource,
                show: showEdit,
                actions,
              })}
            </Table>
          </Col>
        </Row>
      </List>

      {editForm}
      {createForm}
    </>
  )
}
