import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as BookStore from '@crud/bookstore'

type BookInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const BookInput = ({
  name,
  required,
  selectProps,
  ...props
}: BookInputProps) => {
  const itemToOption = (book: BookStore.Book) => ({
    label: BookStore.bookRenderer(book),
    value: book['@id'],
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
      <BookStore.BookSelect {...selectProps} />
    </Form.Item>
  )
}
