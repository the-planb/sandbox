import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { CustomTagProps } from 'rc-select/es/BaseSelect'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const TagInput = (
  props: SelectProps & { hideCreateButton?: boolean },
) => {
  const itemToOption = (tag: BookStore.Tag) => ({
    label: tag ? BookStore.tagRenderer(tag) : null,
    value: tag ? tag['@id'] : null,
  })

  const tagRender = ({ label, ...props }: CustomTagProps) => (
    <Tag color={'processing'} {...props}>
      {label}
    </Tag>
  )
  const searchFilter = {
    field: 'name',
    operator: 'contains',
  }

  return (
    <Space>
      <EntitySelect
        {...props}
        resource={'bookstore/tags'}
        itemToOption={itemToOption}
        tagRender={tagRender}
        searchFilter={searchFilter}
        createForm={BookStore.TagForm}
      />
    </Space>
  )
}
