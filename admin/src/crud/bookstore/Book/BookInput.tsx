import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const BookInput = ({
  allowCreate = true,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (book: BookStore.Book) => ({
    label: BookStore.bookRenderer(book),
    value: book['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'bookstore/books'}
      itemToOption={itemToOption}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? BookStore.useBookModalForm : undefined}
    />
  )
}
