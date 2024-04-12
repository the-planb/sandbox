'use client'
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
import React from 'react'
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
    ? Media.useReviewModalForm({ action })
    : Media.useReviewDrawerForm({ action })
}

export const useReviewTable = (
  props?: Omit<UseDataTableProps<Media.Review>, 'columns'>,
): UseDataTableReturnType<Media.Review> & {
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
    useDataTable<Media.Review>({
      resource: 'media/reviews',
      columns: [
        {
          dataIndex: 'review',
          width: 'auto',
          title: t('fields.review.column', { ns: 'media/reviews' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.reviewContentRenderer} />
          ),
        },

        {
          dataIndex: 'score',
          width: 'auto',
          title: t('fields.score.column', { ns: 'media/reviews' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },

        {
          dataIndex: 'movie',
          width: 'auto',
          title: t('fields.movie.column', { ns: 'media/reviews' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={Media.movieRenderer} />
          ),
        },
      ],
      filters: {
        review: <TextFilter />,
        score: <RangeFilter />,
        movie: <Media.MovieFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'media/reviews',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: Media.Review) =>
          editButton({
            resource: 'media/reviews',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: Media.Review) => {
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
