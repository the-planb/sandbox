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
    ? Music.useSongModalForm({ action })
    : Music.useSongDrawerForm({ action })
}

export const useSongTable = (
  props?: Omit<UseDataTableProps<Music.Song>, 'columns'>,
): UseDataTableReturnType<Music.Song> & {
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
    useDataTable<Music.Song>({
      resource: 'music/songs',
      columns: [
        {
          dataIndex: 'title',
          width: 'auto',
          title: t('fields.title.column', { ns: 'music/songs' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'duration',
          width: 'auto',
          title: t('fields.duration.column', { ns: 'music/songs' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'album',
          width: 'auto',
          title: t('fields.album.column', { ns: 'music/songs' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Music.discoRenderer} />
          ),
        },
      ],
      filters: {
        title: <TextFilter />,
        duration: <RangeFilter />,
        album: <Music.DiscoFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'music/songs',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Music.Song) =>
          editButton({
            resource: 'music/songs',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Music.Song) => {
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
