import { SelectProps, Space } from 'antd'
import React from 'react'
import { type BaseRecord } from '@refinedev/core'
import { EntitySelect, type RemoteFilter } from '@planb/components'
import * as BookStore from '@crud/bookstore'

export const AuthorInput = (props: SelectProps) => {
  const itemToOption = (author: BookStore.Author) => ({
    label: author ? BookStore.authorRenderer(author) : null,
    value: author ? author['@id'] : null,
  })

  //  const remote: RemoteFilter = (term: any) => {
  //      return {
  //          field: 'name',
  //          operator: 'partial',
  //          value: term,
  //      }
  //  }

  //  const tagRender = ({ label, ...props }: CustomTagProps) => {
  //  return (
  //
  //<Tag color={'processing'} {...props}>
  // {' '}{label}{' '}
  //
  //</Tag>
  //  )
  //  }

  return (
    <Space>
      <EntitySelect
        {...props}
        resource={'bookstore/authors'}
        itemToOption={itemToOption}
        // mode='multiple'
        // tagRender={tagRender}
        // remote={remote}
        createForm={BookStore.AuthorForm}
      />
    </Space>
  )
}
