import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const TagInput = ({
  allowCreate = true,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (tag: BookStore.Tag) => ({
    label: BookStore.tagRenderer(tag),
    value: tag['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'bookstore/tags'}
      itemToOption={itemToOption}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? BookStore.useTagModalForm : undefined}
    />
  )
}
