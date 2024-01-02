import {
  Create,
  Edit,
  useForm,
  UseFormProps,
  UseFormReturnType,
} from '@refinedev/antd'
import React, { FC } from 'react'
import * as BookStore from '@crud/bookstore'
import { FormAction, useTranslate } from '@refinedev/core'
import {
  formCss as css,
  FooterButtons,
  HeaderButtons,
  normalizeFormProps,
} from '@planb/components'
import { FormProps } from 'antd'

type UseBookFormProps = UseFormProps<BookStore.Book> & { action: FormAction }
type UseBookFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useBookForm = (props: UseBookFormProps): UseBookFormReturnType => {
  const t = useTranslate()
  const {
    formProps: _formProps,
    formLoading,
    form,
    onFinish,
    redirect,
  } = useForm<BookStore.Book>({
    resource: 'bookstore/books',
    submitOnEnter: true,
    redirect: false,
    ...props,
  })

  const wrapperProps = {
    className: css.wrapper,
  }

  const footerButtonsProps = {
    form,
    onFinish,
    redirect,
    action: props.action,
    resource: 'bookstore/books',
  }

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'bookstore/books' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/books'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.BookForm {...formProps} />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'bookstore/books' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/books'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.BookForm {...formProps} />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
