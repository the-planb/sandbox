import React from 'react'
import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Media from '@crud/media'

type ReviewFieldProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const ReviewField = ({
  name,
  required,
  selectProps,
  ...props
}: ReviewFieldProps) => {
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <Media.ReviewSelect {...selectProps} />
    </Form.Item>
  )
}
