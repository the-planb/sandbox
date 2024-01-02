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

type UseAuthorFormProps = UseFormProps<BookStore.Author> & {
  action: FormAction
}
type UseAuthorFormReturnType = {
  Form: FC<Partial<UseFormReturnType>>
}

export const useAuthorForm = (
  props: UseAuthorFormProps,
): UseAuthorFormReturnType => {
  const t = useTranslate()
  const {
    formProps: _formProps,
    formLoading,
    form,
    onFinish,
    redirect,
  } = useForm<BookStore.Author>({
    resource: 'bookstore/authors',
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
    resource: 'bookstore/authors',
  }

  const formProps: FormProps = normalizeFormProps(_formProps)

  const Form =
    props.action === 'create'
      ? (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Create
                title={t('titles.create', { ns: 'bookstore/authors' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/authors'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.AuthorForm {...formProps} />
              </Create>
            </>
          )
        }
      : (props: Partial<UseFormReturnType>) => {
          return (
            <>
              <Edit
                title={t('titles.edit', { ns: 'bookstore/authors' })}
                breadcrumb={false}
                wrapperProps={wrapperProps}
                headerButtons={<HeaderButtons resource={'bookstore/authors'} />}
                footerButtons={<FooterButtons {...footerButtonsProps} />}
                isLoading={formLoading}>
                <BookStore.AuthorForm {...formProps} />
              </Edit>
            </>
          )
        }

  return {
    Form,
  }
}
