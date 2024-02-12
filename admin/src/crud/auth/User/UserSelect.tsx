import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Auth from '@crud/auth'

export const UserSelect = ({
  allowCreate = true,
  value,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (user: Auth.User) => ({
    label: Auth.userRenderer(user),
    value: user['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'auth/users'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Auth.useUserModalForm : undefined}
    />
  )
}
