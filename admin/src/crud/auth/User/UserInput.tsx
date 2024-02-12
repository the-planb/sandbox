import { Form, FormItemProps, type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Auth from '@crud/auth'

type UserInputProps = FormItemProps & {
  selectProps?: SelectProps & { allowCreate?: boolean }
}

export const UserInput = ({
  name,
  required,
  selectProps,
  ...props
}: UserInputProps) => {
  const itemToOption = (user: Auth.User) => ({
    label: Auth.userRenderer(user),
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
      <Auth.UserSelect {...selectProps} />
    </Form.Item>
  )
}
