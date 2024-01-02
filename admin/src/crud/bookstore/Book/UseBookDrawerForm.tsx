import {
  UseFormProps,
  UseFormReturnType,
  useDrawerForm,
  Create,
  Edit,
} from '@refinedev/antd'
import React, { FC, useCallback } from 'react'
import * as BookStore from '@crud/bookstore'
import { normalizeFormProps } from '@planb/components'
import { BaseKey, FormAction, useTranslate } from '@refinedev/core'
import { FormProps, Drawer, Spin } from 'antd'

type UseBookDrawerFormProps = UseFormProps<BookStore.Book> & {
  action: FormAction
}
type UseBookDrawerFormReturnType = {
  show: (id?: BaseKey) => void
  Form: FC<Partial<UseFormReturnType>>
}

export const useBookDrawerForm = (
  props: UseBookDrawerFormProps,
): UseBookDrawerFormReturnType => {
  const t = useTranslate()

  const {
    show,
    saveButtonProps,
    drawerProps,
    formProps: _formProps,
    formLoading,
  } = useDrawerForm<BookStore.Book>({
    resource: 'bookstore/books',
    submitOnEnter: true,
    redirect: false,
    ...props,
  })

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('bookstore/books.titles.create')}
              width={800}>
              <Create
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <BookStore.BookForm {...formProps} />
              </Create>
            </Drawer>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <Drawer
              {...drawerProps}
              title={t('bookstore/books.titles.edit')}
              width={800}>
              <Edit
                isLoading={formLoading}
                saveButtonProps={{ ...saveButtonProps, icon: false }}
                breadcrumb={false}
                goBack={false}
                title={false}>
                <BookStore.BookForm {...formProps} />
              </Edit>
            </Drawer>
          )
        }

  return {
    show,
    Form,
  }
}
