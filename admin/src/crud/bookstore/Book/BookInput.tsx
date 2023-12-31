import { type SelectProps, Space } from 'antd'
import React from 'react'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const BookInput = (props: SelectProps) => {
  const itemToOption = (book: BookStore.Book) => ({
    label: book ? BookStore.bookRenderer(book) : null,
    value: book ? book['@id'] : null,
  })

  //  const remote: RemoteFilter = (term: any) => {
  //      return {
  //          field: 'name',
  //          operator: 'partial',
  //          value: term,
  //      }
  //  }

  //  const tagRender = ({ label, ...props }: CustomTagProps) => {
  //  return (
  //
  //<Tag color={'processing'} {...props}>
  // {' '}{label}{' '}
  //
  //</Tag>
  //  )
  //  }

  return (
    <Space>
      <EntitySelect
        {...props}
        resource={'bookstore/books'}
        itemToOption={itemToOption}
        // mode='multiple'
        // tagRender={tagRender}
        // remote={remote}
        createForm={BookStore.BookForm}
      />
    </Space>
  )
}
