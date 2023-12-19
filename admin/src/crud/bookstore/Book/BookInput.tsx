import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { CustomTagProps } from 'rc-select/es/BaseSelect'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components'

import * as BookStore from '@crud/bookstore'

export const BookInput = (props: SelectProps) => {
  const itemToOption = (book: BookStore.Book) => ({
    label: book ? BookStore.bookRenderer(book) : null,
    value: book ? book['@id'] : null,
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
        resource={'bookstore/books'}
        itemToOption={itemToOption}
        // mode='multiple'
        tagRender={tagRender}
        //    remote={remote}
        createForm={BookStore.BookForm}
      />
    </Space>
  )
}
