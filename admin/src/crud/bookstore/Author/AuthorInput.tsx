import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

type AuthorInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const AuthorInput = ({
  name,
  required,
  selectProps,
  ...props
}: AuthorInputProps) => {
  const itemToOption = (author: BookStore.Author) => ({
    label: BookStore.authorRenderer(author),
    value: author['@id'],
  })

  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <BookStore.AuthorSelect {...selectProps} />
    </Form.Item>
  )
}
