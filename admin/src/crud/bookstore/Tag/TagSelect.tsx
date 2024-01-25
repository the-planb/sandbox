import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const TagSelect = ({
  allowCreate = true,
  value,
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
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? BookStore.useTagModalForm : undefined}
    />
  )
}
