'use client'

import { Table } from 'antd'
import { useTranslate } from '@refinedev/core'
import { TableData, TableCell } from '@planb/components/table'
import { RangeFilter, TextFilter } from '@planb/components/filters'
import * as BookStore from '@crud/bookstore'

export const AuthorList = () => {
  const t = useTranslate()

  return (
    <TableData<BookStore.Author>
      resource={'bookstore/authors'}
      // edit={{modal: BookForm}}
      // create={{drawer: BookForm, width: 1000}}
      //    tableProps={{
      //        expandable: {
      //            expandedRowRender: (record) => {
      //                return '...'
      //            },
      //        },
      //    }}

      filters={{
        name: <TextFilter />,
      }}>
      <Table.Column
        dataIndex='name'
        width={'auto'}
        title={t('bookstore/authors.columns.name')}
        sorter={true}
        render={(value) => (
          <TableCell value={BookStore.fullNameRenderer(value)} />
        )}
      />
    </TableData>
  )
}
