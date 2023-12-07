import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect } from '@planb/components'
import * as BookStore from '@crud/bookstore'
import { CustomTagProps } from 'rc-select/es/BaseSelect'

export const TagInput = (props: SelectProps) => {
  const itemToOption = (tag: BookStore.Tag) => ({
    label: tag ? BookStore.tagRenderer(tag) : null,
    value: tag ? tag['@id'] : null,
  })

  //  const remote: RemoteFilter = (term: any) => {
  //      return {
  //          field: 'name',
  //          operator: 'partial',
  //          value: term,
  //      }
  //  }

  const tagRender = ({ label, ...props }: CustomTagProps) => {
    return (
      <Tag color={'processing'} {...props}>
        {' '}
        {label}{' '}
      </Tag>
    )
  }

  return (
    <Space>
      <EntitySelect
        {...props}
        resource={'bookstore/tags'}
        itemToOption={itemToOption}
        // mode='multiple'
        tagRender={tagRender}
        // remote={remote}
        createForm={BookStore.TagForm}
      />
    </Space>
  )
}
