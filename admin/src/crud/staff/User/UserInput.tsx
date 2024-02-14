import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Staff from '@crud/staff'

type UserInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const UserInput = ({
  name,
  required,
  selectProps,
  ...props
}: UserInputProps) => {
  const itemToOption = (user: Staff.User) => ({
    label: Staff.userRenderer(user),
    value: user['@id'],
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
      <Staff.UserSelect {...selectProps} />
    </Form.Item>
  )
}
