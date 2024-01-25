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
    ? BookStore.useBookModalForm({ action })
    : BookStore.useBookDrawerForm({ action })
}

export const useBookTable = (
  props?: Omit<UseDataTableProps<BookStore.Book>, 'columns'>,
): UseDataTableReturnType<BookStore.Book> & {
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
    useDataTable<BookStore.Book>({
      resource: 'bookstore/books',

      columns: [
        {
          dataIndex: 'title',
          width: 'auto',
          title: t('fields.title.column', { ns: 'bookstore/books' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'price',
          width: 'auto',
          title: t('fields.price.column', { ns: 'bookstore/books' }),
          sorter: true,
          render: (value) => <TableCell value={value} />,
        },
        {
          dataIndex: 'author',
          width: 'auto',
          title: t('fields.author.column', { ns: 'bookstore/books' }),
          sorter: true,
          render: (value) => (
            <TableCell value={value} renderer={BookStore.authorRenderer} />
          ),
        },
        // {
        //   dataIndex: 'tags',
        //   width: 'auto',
        //   title: t('fields.tags.column', { ns: 'bookstore/books' }),
        //   sorter: true,
        //   render: (value) => (
        //     <TableCell value={value} renderer={BookStore.tagRenderer} />
        //   ),
        // },
      ],
      filters: {
        title: <TextFilter />,
        price: <RangeFilter />,
        author: <BookStore.AuthorFilter />,
      },
      headerButtons: (
        <>
          {createButton({
            resource: 'bookstore/books',
            handle: create,
          })}
        </>
      ),
      actions: {
        //            edit: 'default',

        edit: (record: BookStore.Book) =>
          editButton({
            resource: 'bookstore/books',
            record,
            handle: edit,
          }),
        delete: 'default',
        //          otro: (record: BookStore.Book) => {
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
