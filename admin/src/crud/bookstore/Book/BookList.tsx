'use client'

import { Table } from 'antd'
import { useTranslate } from '@refinedev/core'
import { TableData, TableCell } from '@planb/components/table'
import { RangeFilter, TextFilter } from '@planb/components/filters'
import * as BookStore from '@crud/bookstore'

export const BookList = () => {
  const t = useTranslate()

  return (
    <TableData<BookStore.Book>
      resource={'bookstore/books'}
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
        title: <TextFilter />,
        price: <RangeFilter />,
        author: <TextFilter />,
      }}>
      <Table.Column
        dataIndex='title'
        width={'auto'}
        title={t('bookstore/books.columns.title')}
        sorter={true}
        render={(value) => <TableCell value={value} />}
      />
      <Table.Column
        dataIndex='price'
        width={'auto'}
        title={t('bookstore/books.columns.price')}
        sorter={true}
        render={(value) => <TableCell value={value} />}
      />
      <Table.Column
        dataIndex='author'
        width={'auto'}
        title={t('bookstore/books.columns.author')}
        sorter={true}
        render={(value) => (
          <TableCell value={BookStore.authorRenderer(value)} />
        )}
      />
    </TableData>
  )
}
