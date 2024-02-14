import { type SelectProps, Space, Tag } from 'antd'
import React from 'react'
import { EntitySelect, type RemoteFilter, recordToId } from '@planb/components'
import * as Staff from '@crud/staff'

export const UserSelect = ({
  allowCreate = true,
  value,
  ...props
}: SelectProps & { allowCreate?: boolean }) => {
  const itemToOption = (user: Staff.User) => ({
    label: Staff.userRenderer(user),
    value: user['@id'],
  })

  return (
    <EntitySelect
      {...props}
      resource={'staff/users'}
      itemToOption={itemToOption}
      value={recordToId(value)}
      remote={{
        field: 'name',
        operator: 'contains',
      }}
      useCreateForm={allowCreate ? Staff.useUserModalForm : undefined}
    />
  )
}
