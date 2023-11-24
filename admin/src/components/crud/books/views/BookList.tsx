'use client'

import { TableData } from '@planb/components/table'
import { Table } from 'antd'
import { type IBook } from '@model'
import { useTranslate } from '@refinedev/core'
import { RangeFilter, TextFilter } from '@planb/components/filters'

export const BookList = () => {
  const t = useTranslate()

  return (
    <TableData<IBook>
      resource={'bookstore/books'}
      // edit={{modal: BookForm}}
      // create={{drawer: BookForm, width: 1000}}
      filters={{
        title: <TextFilter />,
        summary: <TextFilter />,
        price: <RangeFilter />,
      }}
      tableProps={{
        expandable: {
          expandedRowRender: (record) => {
            return record.title
          },
        },
      }}>
      <Table.Column
        dataIndex='title'
        width={'auto'}
        title={t('bookstore/books.columns.title')}
        sorter={true}
      />

      <Table.Column
        width={200}
        dataIndex={'author'}
        title={t('bookstore/books.columns.author')}
        sorter={true}
        render={(field, record: IBook) => {
          const name = record.author.name ?? {}

          return (
            <>
              {name.lastName}, {name.firstName}
            </>
          )
        }}
      />

      <Table.Column
        width={100}
        dataIndex='price'
        title={t('bookstore/books.columns.price')}
        sorter={true}
        render={(_, record: IBook) => {
          const { price } = record
          return `${price} €`
        }}
      />
    </TableData>
  )
}
