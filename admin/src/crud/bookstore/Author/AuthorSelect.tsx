import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const AuthorSelect = ({
  allowCreate = true,
  value,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (author: BookStore.Author) => ({
    label: BookStore.authorRenderer(author),
    value: author['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'bookstore/authors'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? BookStore.useAuthorModalForm : undefined}
    />
  )
}
