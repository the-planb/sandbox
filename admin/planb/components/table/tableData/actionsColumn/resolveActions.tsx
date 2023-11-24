import {
  type ActionList,
  type ActionProps,
} from '@planb/components/table/tableData/types'
import { DeleteButton, EditButton } from '@refinedev/antd'
import { type FC } from 'react'
import { type BaseKey } from '@refinedev/core'
import { buttonProps } from '@planb/components/table/tableData/buttonProps'

interface DefaultActionsProps {
  resource: string
  show?: (id?: BaseKey) => void
}

const defaultActions = ({
  resource,
  show,
}: DefaultActionsProps): ActionList => {
  return {
    edit: ({ record }) => (
      <EditButton
        resource={resource}
        icon={false}
        size='small'
        recordItemId={record.id}
        {...buttonProps(show, record)}
      />
    ),
    delete: ({ record }) => (
      <DeleteButton size='small' icon={false} recordItemId={record.id} />
    ),
  }
}

type ResolveActionsReturnType = Record<string, FC<ActionProps>>

interface ResolveActionsProps {
  resource: string
  actions?: ActionList
  show?: (id?: BaseKey) => void
}

export const resolveActions = ({
  resource,
  actions,
  show,
}: ResolveActionsProps): ResolveActionsReturnType => {
  const merged = {
    ...defaultActions({
      resource,
      show,
    }),
    ...actions,
  }

  const entries = Object.entries(merged).filter(([key, value]) => {
    return value !== false
  })

  return Object.fromEntries(entries) as ResolveActionsReturnType
}
