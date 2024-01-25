import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const BookSelect = ({
  allowCreate = true,
  value,
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
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? BookStore.useBookModalForm : undefined}
    />
  )
}
