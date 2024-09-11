import React from 'react'
import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Media from '@crud/media'

type MovieFieldProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const MovieField = ({
  name,
  required,
  selectProps,
  ...props
}: MovieFieldProps) => {
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <Media.MovieSelect {...selectProps} />
    </Form.Item>
  )
}
