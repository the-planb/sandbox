import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

type TagInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const TagInput = ({
  name,
  required,
  selectProps,
  ...props
}: TagInputProps) => {
  const itemToOption = (tag: BookStore.Tag) => ({
    label: BookStore.tagRenderer(tag),
    value: tag['@id'],
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
      <BookStore.TagSelect {...selectProps} />
    </Form.Item>
  )
}
