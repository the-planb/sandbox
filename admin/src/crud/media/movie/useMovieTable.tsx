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
    ? Media.useMovieModalForm({ action })
    : Media.useMovieDrawerForm({ action })
}

export const useMovieTable = (
  props?: Omit<UseDataTableProps<Media.Movie>, 'columns'>,
): UseDataTableReturnType<Media.Movie> & {
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
    useDataTable<Media.Movie>({
      resource: 'media/movies',
      columns: [
        {
          dataIndex: 'title',
          width: 'auto',
          title: t('fields.title.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.movieTitleRenderer} />
          ),
        },
        {
          dataIndex: 'releaseYear',
          width: 'auto',
          title: t('fields.releaseYear.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.releaseYearRenderer} />
          ),
        },
        {
          dataIndex: 'director',
          width: 'auto',
          title: t('fields.director.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.directorRenderer} />
          ),
        },
        {
          dataIndex: 'overview',
          width: 'auto',
          title: t('fields.overview.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.overviewRenderer} />
          ),
        },
        {
          dataIndex: 'classification',
          width: 'auto',
          title: t('fields.classification.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.classificationRenderer} />
          ),
        },
        {
          dataIndex: 'koko',
          width: 'auto',
          title: t('fields.koko.column', { ns: 'media/movies' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.scoreRenderer} />
          ),
        },
      ],
      filters: {
        title: <Media.MovieTitleFilter />,
        releaseYear: <Media.ReleaseYearFilter />,
        director: <Media.DirectorFilter />,
        overview: <Media.OverviewFilter />,
        // classification: <Media.ClassificationFilter />,
        koko: <Media.ScoreFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'media/movies',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Media.Movie) =>
          editButton({
            resource: 'media/movies',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Media.Movie) => {
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
