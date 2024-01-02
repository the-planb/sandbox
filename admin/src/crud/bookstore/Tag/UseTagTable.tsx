import * as BookStore from '@crud/bookstore'
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
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

const useAuxForm = ({
  action,
  view,
}: UseAuxFormProps): UseAuxFormReturnType => {
  if (view === 'none') {
    return {
      show: () => {},
      Form: () => <></>,
    }
  }

  return view === 'modal'
    ? BookStore.useTagModalForm({ action })
    : BookStore.useTagDrawerForm({ action })
}

export const useTagTable = (
  props?: Omit<UseDataTableProps<BookStore.Tag>, 'columns'>,
): UseDataTableReturnType<BookStore.Tag> & {
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
    useDataTable<BookStore.Tag>({
      resource: 'bookstore/tags',
      columns: [
        {
          dataIndex: 'name',
          width: 'auto',
          title: t('fields.name.column', { ns: 'bookstore/tags' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
      ],
      filters: {
        name: <TextFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'bookstore/tags',
            //handle: create,
          })}
        </>
      ),
      actions: {
        edit: 'default',
        delete: 'default',
        //          edit: (record: BookStore.Tag)=>editButton({
        //              resource: 'bookstore/tags',
        //              record,
        //              handle: edit
        //          }),
        //          otro: (record: BookStore.Tag) => {
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
