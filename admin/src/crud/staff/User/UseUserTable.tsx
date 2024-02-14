import * as Staff from '@crud/staff'
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
    ? Staff.useUserModalForm({ action })
    : Staff.useUserDrawerForm({ action })
}

export const useUserTable = (
  props?: Omit<UseDataTableProps<Staff.User>, 'columns'>,
): UseDataTableReturnType<Staff.User> & {
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
    useDataTable<Staff.User>({
      resource: 'staff/users',
      columns: [
        {
          dataIndex: 'name',
          width: 'auto',
          title: t('fields.name.column', { ns: 'staff/users' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'email',
          width: 'auto',
          title: t('fields.email.column', { ns: 'staff/users' }),
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
            resource: 'staff/users',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Staff.User) =>
          editButton({
            resource: 'staff/users',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Staff.User) => {
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
