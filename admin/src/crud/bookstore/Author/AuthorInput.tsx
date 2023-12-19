import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { CustomTagProps } from 'rc-select/es/BaseSelect'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components'

import * as BookStore from '@crud/bookstore'

export const AuthorInput = (props: SelectProps) => {
  const itemToOption = (author: BookStore.Author) => ({
    label: author ? BookStore.authorRenderer(author) : null,
    value: author ? author['@id'] : null,
  })

  const remote: RemoteFilter = (term: any) => {
    return {
      field: 'name',
      operator: 'contains',
      value: term,
    }
  }

  const tagRender = ({ label, ...props }: CustomTagProps) => (
    <Tag color={'processing'} {...props}>
      {' '}
      {label}{' '}
    </Tag>
  )

  return (
    <Space>
      <EntitySelect
        {...props}
        resource={'bookstore/authors'}
        itemToOption={itemToOption}
        // mode='multiple'
        tagRender={tagRender}
        //    remote={remote}
        createForm={BookStore.AuthorForm}
      />
    </Space>
  )
}
