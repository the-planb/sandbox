import React from 'react'
import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Media from '@crud/media'

type DirectorFieldProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const DirectorField = ({
  name,
  required,
  selectProps,
  ...props
}: DirectorFieldProps) => {
  return (
    <Form.Item
      {...props}
      name={name}
      rules={[
        {
          required,
        },
      ]}>
      <Media.DirectorSelect {...selectProps} />
    </Form.Item>
  )
}
