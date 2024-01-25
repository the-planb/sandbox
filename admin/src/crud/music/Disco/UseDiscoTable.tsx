import * as Music from '@crud/music'
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
    ? Music.useDiscoModalForm({ action })
    : Music.useDiscoDrawerForm({ action })
}

export const useDiscoTable = (
  props?: Omit<UseDataTableProps<Music.Disco>, 'columns'>,
): UseDataTableReturnType<Music.Disco> & {
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
    useDataTable<Music.Disco>({
      resource: 'music/discos',
      columns: [
        {
          dataIndex: 'title',
          width: 'auto',
          title: t('fields.title.column', { ns: 'music/discos' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        // {
        //   dataIndex: 'songs',
        //   width: 'auto',
        //   title: t('fields.songs.column', { ns: 'music/discos' }),
        //   sorter: true,
        //   render: (value) => (
        //     <TableCell value={value} renderer={Music.songRenderer} />
        //   ),
        // },
      ],
      filters: {
        title: <TextFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'music/discos',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Music.Disco) =>
          editButton({
            resource: 'music/discos',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Music.Disco) => {
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
