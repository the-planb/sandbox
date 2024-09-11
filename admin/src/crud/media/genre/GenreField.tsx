import React from 'react'
import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Media from '@crud/media'

type GenreFieldProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const GenreField = ({
  name,
  required,
  selectProps,
  ...props
}: GenreFieldProps) => {
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <Media.GenreSelect {...selectProps} />
    </Form.Item>
  )
}
