import { type SelectProps, Tag } from 'antd'
import React from 'react'
import {
  EntitySelect,
  type RemoteFilter,
} from '@planb/components/fields/EntitySelect'
import { type BaseRecord } from '@refinedev/core'
import { type CustomTagProps } from 'rc-select/es/BaseSelect'
import { TagForm } from '@components/crud/tags'

export const TagSelect = (props: SelectProps) => {
  const itemToOption = (item: BaseRecord) => {
    return {
      label: item ? item.name : null,
      value: item ? item['@id'] : null,
    }
  }
  const remote: RemoteFilter = (term: any) => {
    return {
      field: 'name',
      operator: 'partial',
      value: term,
    }
  }

  const tagRender = ({ label, ...props }: CustomTagProps) => {
    return (
      <Tag color={'processing'} {...props}>
        {' '}
        {label}{' '}
      </Tag>
    )
  }

  return (
    <EntitySelect
      {...props}
      mode='multiple'
      resource={'bookstore/tags'}
      itemToOption={itemToOption}
      tagRender={tagRender}
      remote={remote}
      createForm={TagForm}
    />
  )
}
