import React from 'react'
import { UseFormReturnType } from '@refinedev/antd'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import {
  createButton,
  editButton,
  TableCell,
  TextFilter,
  RangeFilter,
  useDataTable,
  UseDataTableProps,
  UseDataTableReturnType,
} from '@planb/components'
import { FC } from 'react'
import * as Media from '@crud/media'

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
    ? Media.useDirectorModalForm({ action })
    : Media.useDirectorDrawerForm({ action })
}

export const useDirectorTable = (
  props?: Omit<UseDataTableProps<Media.Director>, 'columns'>,
): UseDataTableReturnType<Media.Director> & {
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
    useDataTable<Media.Director>({
      resource: 'media/directors',
      columns: [
        {
          dataIndex: 'name',
          width: 'auto',
          title: t('fields.name.column', { ns: 'media/directors' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.fullNameRenderer} />
          ),
        },
      ],
      filters: {
        name: <Media.FullNameFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'media/directors',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Media.Director) =>
          editButton({
            resource: 'media/directors',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Media.Director) => {
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
