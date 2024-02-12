import * as Auth from '@crud/auth'
import {
  createButton,
  editButton,
  TextFilter,
  RangeFilter,
  useDataTable,
  UseDataTableProps,
  UseDataTableReturnType,
  TableCell,
} from '@planb/components'
import { FC } from 'react'
import { UseFormReturnType } from '@refinedev/antd'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'

type UseAuxFormProps = {
  action: FormAction
  view: 'drawer' | 'modal' | 'none'
}

type UseAuxFormReturnType = {
  show?: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

const useAuxForm = ({
  action,
  view,
}: UseAuxFormProps): UseAuxFormReturnType => {
  if (view === 'none') {
    return {
      show: undefined,
      Form: () => <></>,
    }
  }

  return view === 'modal'
    ? Auth.useUserModalForm({ action })
    : Auth.useUserDrawerForm({ action })
}

export const useUserTable = (
  props?: Omit<UseDataTableProps<Auth.User>, 'columns'>,
): UseDataTableReturnType<Auth.User> & {
  EditForm: FC<Partial<UseFormReturnType>>
  CreateForm: FC<Partial<UseFormReturnType>>
} => {
  const t = useTranslate()

  const { show: edit, Form: EditForm } = useAuxForm({
    action: 'edit',
    view: 'none',
  })

  const { show: create, Form: CreateForm } = useAuxForm({
    action: 'create',
    view: 'none',
  })

  const { listProps, flexProps, tableProps, searchProps, hasFilters } =
    useDataTable<Auth.User>({
      resource: 'auth/users',
      columns: [
        {
          dataIndex: 'name',
          width: 'auto',
          title: t('fields.name.column', { ns: 'auth/users' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'email',
          width: 'auto',
          title: t('fields.email.column', { ns: 'auth/users' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
      ],
      filters: {
        name: <TextFilter />,
        email: <TextFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'auth/users',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Auth.User) =>
          editButton({
            resource: 'auth/users',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Auth.User) => {
        //              return <>...</>
        //          }
      },
      ...props,
    })

  return {
    listProps,
    flexProps,
    tableProps,
    searchProps,
    hasFilters,
    EditForm,
    CreateForm,
  }
}
