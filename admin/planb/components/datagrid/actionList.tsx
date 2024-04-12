import { BaseKey, BaseRecord, useDataProvider } from '@refinedev/core'
import { ColumnType } from 'antd/es/table'
import { Space } from 'antd'
import { Fragment } from 'react'
import {
  CreateButton,
  CreateButtonProps,
  DeleteButton,
  DeleteButtonProps,
  EditButton,
  EditButtonProps,
} from '@refinedev/antd'

type Action<TData extends BaseRecord> = (record: TData) => JSX.Element

export type ActionList<TData extends BaseRecord> = {
  [key: string]: false | 'default' | Action<TData>
}

type SanitizeActionProps<TData extends BaseRecord> = {
  key: string
  value: false | 'default' | Action<TData>
  resource: string
}

export const createButton = ({
  handle,
  ...props
}: CreateButtonProps & {
  handle?: (id?: BaseKey) => void
}) => {
  if (handle !== undefined) {
    props.onClick = () => {
      handle()
    }
  }

  return <CreateButton icon={false} {...props} />
}

export const editButton = ({
  handle,
  record,
  ...props
}: EditButtonProps & {
  handle?: (id?: BaseKey) => void
  record: BaseRecord
}) => {
  if (handle !== undefined) {
    props.onClick = () => {
      handle(record.id)
    }
  }

  return (
    <EditButton
      icon={false}
      size={'small'}
      recordItemId={record.id}
      {...props}
    />
  )
}

export const deleteButton = (props: DeleteButtonProps) => {
  return <DeleteButton icon={false} size={'small'} {...props} />
}

const sanitizeAction = <TData extends BaseRecord>({
  key,
  value,
  resource,
}: SanitizeActionProps<TData>): false | Action<TData> => {
  if (value !== 'default') {
    return value
  }

  if (key === 'edit') {
    return (record: TData) => {
      return editButton({
        resource,
        record,
      })
    }
  }

  if (key === 'delete') {
    return (record: TData) => {
      return deleteButton({
        resource: resource,
        recordItemId: record.id,
      })
    }
  }

  return false
}

type MakeActionsProps<TData extends BaseRecord> = {
  resource: string
  actions: ActionList<TData>
}

export const makeActions = <TData extends BaseRecord>({
  resource,
  actions,
}: MakeActionsProps<TData>): ColumnType<TData> => {
  return {
    fixed: 'right',
    width: 100,
    render: (_, record: TData) => {
      return (
        <Space>
          {Object.entries(actions).map(([key, value]) => {
            const action = sanitizeAction<TData>({
              key,
              value,
              resource,
            })
            return <Fragment key={key}>{action && action(record)}</Fragment>
          })}
        </Space>
      )
    },
  }
}
